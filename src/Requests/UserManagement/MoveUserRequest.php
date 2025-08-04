<?php

namespace SpringfieldClinic\LaravelAdmanagerPlusSdk\Requests\UserManagement;

use Saloon\Enums\Method;
use Saloon\Http\Response;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\DTOs\User\MoveUserResponse;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\Requests\BaseRequest;

class MoveUserRequest extends BaseRequest
{
    protected Method $method = Method::POST;

    public function __construct(
        protected array $users = [],
        protected string $targetOU = '',
    ) {}

    public function resolveEndpoint(): string
    {
        return '/MoveUser';
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
            'targetOU' => $this->targetOU,
        ], fn ($v) => $v !== null && $v !== '');
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();

        if (count($data) > 1) {
            $responses = [];
            foreach ($data as $item) {
                $responses[] = new MoveUserResponse(
                    destinationOUName: $item['destinationOUName'] ?? '',
                    sAMAccountName: $item['sAMAccountName'] ?? '',
                    objectGUID: $item['objectGUID'] ?? '',
                    objectSID: $item['objectSID'] ?? '',
                    distinguishedName: $item['distinguishedName'] ?? '',
                    userPrincipalName: $item['userPrincipalName'] ?? '',
                    ouName: $item['ouName'] ?? '',
                    statusMessage: $item['statusMessage'] ?? '',
                    status: $item['status'] ?? ''
                );
            }

            return $responses;
        } else {
            return [
                new MoveUserResponse(
                    destinationOUName: $item['destinationOUName'] ?? '',
                    sAMAccountName: $item['sAMAccountName'] ?? '',
                    objectGUID: $item['objectGUID'] ?? '',
                    objectSID: $item['objectSID'] ?? '',
                    distinguishedName: $item['distinguishedName'] ?? '',
                    userPrincipalName: $item['userPrincipalName'] ?? '',
                    ouName: $item['ouName'] ?? '',
                    statusMessage: $item['statusMessage'] ?? '',
                    status: $item['status'] ?? ''
                ),
            ];
        }
    }
}
