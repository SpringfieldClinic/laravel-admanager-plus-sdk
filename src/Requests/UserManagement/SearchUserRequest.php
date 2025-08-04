<?php

namespace SpringfieldClinic\LaravelAdmanagerPlusSdk\Requests\UserManagement;

use Saloon\Enums\Method;
use Saloon\Http\Response;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\DTOs\User\UserResponse;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\DTOs\User\UserSearchResponse;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\Requests\BaseRequest;

class SearchUserRequest extends BaseRequest
{
    protected Method $method = Method::GET;

    public function __construct(
        protected ?string $searchText = null,
        protected int $range = 10,
        protected int $startIndex = 1,
        protected bool $refresh = false,
        protected ?string $sortColumn = null,
        protected ?bool $ascending = true,
        protected ?string $select = null,
        protected ?string $filter = null,
        protected ?string $domainList = null
    ) {}

    public function resolveEndpoint(): string
    {
        return '/SearchUser';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'searchText' => $this->searchText,
            'range' => $this->range,
            'startIndex' => $this->startIndex,
            'refresh' => $this->refresh ? 'true' : 'false',
            'sortColumn' => $this->sortColumn,
            'ascending' => $this->ascending ? 'true' : 'false',
            'select' => $this->select,
            'filter' => $this->filter,
            'domainList' => $this->domainList,
        ], fn ($v) => $v !== null && $v !== '');
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();

        $users = [];
        if (isset($data['UsersList']) && is_array($data['UsersList'])) {
            foreach ($data['UsersList'] as $item) {
                $users[] = new UserResponse(
                    logonName: $item['LOGON_NAME'] ?? '',
                    distinguishedName: $item['DISTINGUISHED_NAME'] ?? '',
                    employeeId: $item['EMPLOYEE_ID'] ?? '',
                    initial: $item['INITIAL'] ?? '',
                    lastName: $item['LAST_NAME'] ?? '',
                    domainName: $item['DOMAIN_NAME'] ?? '',
                    firstName: $item['FIRST_NAME'] ?? '',
                    displayName: $item['DISPLAY_NAME'] ?? '',
                    ouName: $item['OU_NAME'] ?? '',
                    city: $item['CITY'] ?? '',
                    country: $item['COUNTRY'] ?? '',
                    emailAddress: $item['EMAIL_ADDRESS'] ?? '',
                    sidString: $item['SID_STRING'] ?? '',
                    objectGuid: $item['OBJECT_GUID'] ?? '',
                    streetAddress: $item['STREET_ADDRESS'] ?? '',
                    mobile: $item['MOBILE'] ?? '',
                    samAccountName: $item['SAM_ACCOUNT_NAME'] ?? ''
                );
            }
        }

        return new UserSearchResponse(
            status: $data['status'] ?? '',
            statusMessage: $data['statusMessage'] ?? '',
            count: $data['Count'] ?? 0,
            users: $users
        );
    }
}
