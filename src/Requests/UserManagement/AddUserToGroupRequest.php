<?php

namespace SpringfieldClinic\LaravelAdmanagerPlusSdk\Requests\UserManagement;

use Saloon\Enums\Method;
use Saloon\Http\Response;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\DTOs\User\AddUserToGroupResponse;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\Requests\BaseRequest;

class AddUserToGroupRequest extends BaseRequest
{
    protected Method $method = Method::POST;

    public function __construct(
        protected array $users = [],
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
            'addGroup' => $this->addGroup,
            'primaryGroup' => $this->primaryGroup,
        ], fn ($v) => $v !== null && $v !== '');
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
                ),
            ];
        }
    }
}
