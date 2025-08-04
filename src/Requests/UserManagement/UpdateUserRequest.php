<?php

namespace SpringfieldClinic\LaravelAdmanagerPlusSdk\Requests\UserManagement;

use Saloon\Enums\Method;
use Saloon\Http\Response;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\DTOs\User\UpdateUserResponse;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\Requests\BaseRequest;

class UpdateUserRequest extends BaseRequest
{
    protected Method $method = Method::POST;

    public function __construct(
        protected array $users = [],
        protected string $matchLdapName = '',
    ) {}

    public function resolveEndpoint(): string
    {
        return '/ModifyUserAttributes';
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
                    'cn',
                    'name',
                    'givenName',
                    'sn',
                    'displayName',
                    'profilePath',
                    'scriptPath',
                    'employeeNumber',
                ],
                data: $this->users
            ),
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
