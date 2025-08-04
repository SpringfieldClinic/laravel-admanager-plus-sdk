<?php

namespace SpringfieldClinic\LaravelAdmanagerPlusSdk\Requests\OUManagement;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\DTOs\OU\OUResponse;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\DTOs\OU\OUSearchResponse;

class SearchOURequest extends Request
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
        return '/SearchOU';
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

        $ous = [];
        if (isset($data['OuLists']) && is_array($data['OuLists'])) {
            foreach ($data['OuLists'] as $item) {
                $ous[] = new OUResponse(
                    ouName: $item['OU_NAME'] ?? '',
                    distinguishedName: $item['DISTINGUISHED_NAME'] ?? '',
                    city: $item['CITY'] ?? '',
                    country: $item['COUNTRY'] ?? '',
                    stateProvince: $item['STATE_PROVINCE'] ?? '',
                    objectGuid: $item['OBJECT_GUID'] ?? '',
                    manager: $item['MANAGER'] ?? '',
                    name: $item['NAME'] ?? '',
                );
            }
        }

        return new OUSearchResponse(
            status: $data['status'] ?? '',
            statusMessage: $data['statusMessage'] ?? '',
            count: $data['count'] ?? 0,
            ous: $ous
        );
    }
}
