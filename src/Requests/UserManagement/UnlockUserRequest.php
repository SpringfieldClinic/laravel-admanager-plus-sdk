<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\Requests\UserManagement;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\User\UnlockUserResponse;

class UnlockUserRequest extends Request
{
    protected Method $method = Method::POST;

    public function __construct(
        protected string $inputFormat = '',
    ) {}

    public function resolveEndpoint(): string
    {
        return '/UnlockUser';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'inputFormat' => $this->inputFormat,
        ], fn($v) => $v !== null && $v !== '');
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();

        if (count($data) > 1) {
            $responses = [];
            foreach ($data as $item) {
                $responses[] = new UnlockUserResponse(
                    userPrincipalName: $item['userPrincipalName'] ?? '',
                    sAMAccountName: $item['sAMAccountName'] ?? '',
                    objectSID: $item['objectSID'] ?? '',
                    statusMessage: $item['statusMessage'] ?? ''
                );
            }
            return $responses;
        } else {
            return [
                new UnlockUserResponse(
                    userPrincipalName: $item['userPrincipalName'] ?? '',
                    sAMAccountName: $item['sAMAccountName'] ?? '',
                    objectSID: $item['objectSID'] ?? '',
                    statusMessage: $item['statusMessage'] ?? ''
                )
            ];
        }
    }
}
