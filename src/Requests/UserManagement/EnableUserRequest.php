<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\Requests\UserManagement;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\User\EnableUserResponse;

class EnableUserRequest extends Request
{
    protected Method $method = Method::POST;

    public function __construct(
        protected ?string $inputFormat = '',
        protected string $accountExpires = 'Never',
        protected string $expireTime = ''
    ) {}

    public function resolveEndpoint(): string
    {
        return '/EnableUser';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'inputFormat' => $this->inputFormat,
            'accountExpires' => $this->accountExpires,
            'expireTime' => $this->expireTime,
        ], fn($v) => $v !== null && $v !== '');
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();

        if (count($data) > 1) {
            $responses = [];
            foreach ($data as $item) {
                $responses[] = new EnableUserResponse(
                    userPrincipalName: $item['userPrincipalName'] ?? '',
                    sAMAccountName: $item['sAMAccountName'] ?? '',
                    objectSID: $item['objectSID'] ?? '',
                    statusMessage: $item['statusMessage'] ?? ''
                );
            }
            return $responses;
        } else {
            return [
                new EnableUserResponse(
                    userPrincipalName: $item['userPrincipalName'] ?? '',
                    sAMAccountName: $item['sAMAccountName'] ?? '',
                    objectSID: $item['objectSID'] ?? '',
                    statusMessage: $item['statusMessage'] ?? ''
                )
            ];
        }
    }
}
