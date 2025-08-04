<?php

namespace SpringfieldClinic\LaravelAdmanagerPlusSdk\Requests\UserManagement;

use Saloon\Enums\Method;
use Saloon\Http\Response;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\DTOs\User\DisableUserResponse;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\Requests\BaseRequest;

class DisableUserRequest extends BaseRequest
{
    protected Method $method = Method::POST;

    public function __construct(
        protected array $users = [],
    ) {}

    public function resolveEndpoint(): string
    {
        return '/DisableUser';
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
        ], fn ($v) => $v !== null && $v !== '');
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();

        if (count($data) > 1) {
            $responses = [];
            foreach ($data as $item) {
                $responses[] = new DisableUserResponse(
                    userPrincipalName: $item['userPrincipalName'] ?? '',
                    sAMAccountName: $item['sAMAccountName'] ?? '',
                    objectSID: $item['objectSID'] ?? '',
                    statusMessage: $item['statusMessage'] ?? ''
                );
            }

            return $responses;
        } else {
            return [
                new DisableUserResponse(
                    userPrincipalName: $item['userPrincipalName'] ?? '',
                    sAMAccountName: $item['sAMAccountName'] ?? '',
                    objectSID: $item['objectSID'] ?? '',
                    statusMessage: $item['statusMessage'] ?? ''
                ),
            ];
        }
    }
}
