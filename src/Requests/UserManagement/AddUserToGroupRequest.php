<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\Requests\UserManagement;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\User\AddUserToGroupResponse;

class AddUserToGroupRequest extends Request
{
    protected Method $method = Method::POST;

    public function __construct(
        protected string $inputFormat = '',
        protected string $addGroup = '',
        protected ?string $primaryGroup = '',
    ) {}

    public function resolveEndpoint(): string
    {
        return '/AddUsersToGroup';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'inputFormat' => $this->inputFormat,
            'addGroup' => $this->addGroup,
            'primaryGroup' => $this->primaryGroup,
        ], fn($v) => $v !== null && $v !== '');
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();

        if (count($data) > 1) {
            $responses = [];
            foreach ($data as $item) {
                $responses[] = new AddUserToGroupResponse(
                    status: $item['status'] ?? '',
                    statusMessage: $item['statusMessage'] ?? '',
                    sAMAccountName: $item['SAM ACCOUNT NAME'] ?? '',
                    userPrincipalName: $item['userPrincipalName'] ?? '',
                );
            }
            return $responses;
        } else {
            return [
                new AddUserToGroupResponse(
                    status: $item['status'] ?? '',
                    statusMessage: $item['statusMessage'] ?? '',
                    sAMAccountName: $item['SAM ACCOUNT NAME'] ?? '',
                    userPrincipalName: $item['userPrincipalName'] ?? '',
                )
            ];
        }
    }
}
