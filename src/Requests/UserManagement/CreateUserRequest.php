<?php

namespace SpringfieldClinic\LaravelAdmanagerPlusSdk\Requests\UserManagement;

use Saloon\Enums\Method;
use Saloon\Http\Response;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\DTOs\User\CreateUserResponse;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\Requests\BaseRequest;

class CreateUserRequest extends BaseRequest
{
    protected Method $method = Method::POST;

    public function __construct(
        protected array $users = [],
    ) {}

    public function resolveEndpoint(): string
    {
        return '/CreateUser';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'inputFormat' => $this->buildInputFormatString(
                requiredFields: [
                    'givenName',
                    'sn',
                    'sAMAccountName',
                    'password',
                    'title',
                    'department',
                    'company',
                ],
                data: $this->users
            ),
        ], fn ($v) => $v !== null && $v !== '');
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();

        if (count($data) > 1) {
            $responses = [];
            foreach ($data as $item) {
                $responses[] = new CreateUserResponse(
                    status: $item['status'] ?? '',
                    statusMessage: $item['statusMessage'] ?? '',
                    logOnName: $item['LOG_ON_NAME'] ?? '',
                    username: $item['USER_NAME'] ?? '',
                    password: $item['USER_PASSWORD'] ?? ''
                );
            }

            return $responses;
        } else {
            return [
                new CreateUserResponse(
                    status: $item['status'] ?? '',
                    statusMessage: $item['statusMessage'] ?? '',
                    logOnName: $item['LOG_ON_NAME'] ?? '',
                    username: $item['USER_NAME'] ?? '',
                    password: $item['USER_PASSWORD'] ?? ''
                ),
            ];
        }
    }
}
