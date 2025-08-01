<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\Requests\UserManagement;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\User\UpdateUserResponse;

class UpdateUserRequest extends Request
{
    protected Method $method = Method::POST;

    public function __construct(
        protected string $inputFormat = '',
        protected string $matchLdapName = '',
    ) {}

    public function resolveEndpoint(): string
    {
        return '/ModifyUserAttributes';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'inputFormat' => $this->inputFormat,
            'match_ldap_name' => $this->matchLdapName,
        ], fn ($v) => $v !== null && $v !== '');
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();

        if (count($data) > 1) {
            $responses = [];
            foreach ($data as $item) {
                $responses[] = new UpdateUserResponse(
                    status: $item['status'] ?? '',
                    statusMessage: $item['statusMessage'] ?? '',
                    sAMAccountName: $item['SAM ACCOUNT NAME'] ?? '',
                    userPrincipalName: $item['USER_NAME'] ?? '',
                );
            }

            return $responses;
        } else {
            return [
                new UpdateUserResponse(
                    status: $item['status'] ?? '',
                    statusMessage: $item['statusMessage'] ?? '',
                    sAMAccountName: $item['SAM ACCOUNT NAME'] ?? '',
                    userPrincipalName: $item['USER_NAME'] ?? '',
                ),
            ];
        }
    }
}
