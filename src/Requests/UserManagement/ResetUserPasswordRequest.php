<?php

namespace SpringfieldClinic\LaravelAdmanagerPlusSdk\Requests\UserManagement;

use Saloon\Enums\Method;
use Saloon\Http\Response;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\DTOs\User\ResetUserPasswordResponse;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\Requests\BaseRequest;

class ResetUserPasswordRequest extends BaseRequest
{
    protected Method $method = Method::POST;

    public function __construct(
        protected array $users = [],
        protected string $passwordType = 'password',
        protected string $pwd = '',
    ) {}

    public function resolveEndpoint(): string
    {
        return '/ResetPwd';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'inputFormat' => $this->buildInputFormatString(
                requiresOneOfFields: [
                    'sAMAccountName',
                    'userPrincipalName',
                    'distinguishedName',
                    'mail',
                    'employeeID',
                    'objectGUID',
                    'objectSID',
                ],
                data: $this->users
            ),
            'passwordType' => $this->passwordType,
            'pwd' => $this->pwd,
        ], fn ($v) => $v !== null && $v !== '');
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();

        if (count($data) > 1) {
            $responses = [];
            foreach ($data as $item) {
                $responses[] = new ResetUserPasswordResponse(
                    userPrincipalName: $item['userPrincipalName'] ?? '',
                    sAMAccountName: $item['sAMAccountName'] ?? '',
                    objectSID: $item['objectSID'] ?? '',
                    statusMessage: $item['statusMessage'] ?? ''
                );
            }

            return $responses;
        } else {
            return [
                new ResetUserPasswordResponse(
                    userPrincipalName: $item['userPrincipalName'] ?? '',
                    sAMAccountName: $item['sAMAccountName'] ?? '',
                    objectSID: $item['objectSID'] ?? '',
                    statusMessage: $item['statusMessage'] ?? ''
                ),
            ];
        }
    }
}
