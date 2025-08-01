<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\Requests\GroupManagement;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\Group\GroupSearchResponse;

class SearchGroupRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected ?string $searchText = null,
        protected int $range = 10,
        protected int $startIndex = 1,
        protected bool $refresh = false,
        protected ?string $isPrimaryGroup = false,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/SearchGroup';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'searchText' => $this->searchText,
            'RANGE' => $this->range,
            'FROM_INDEX' => $this->startIndex,
            'refresh' => $this->refresh ? 'true' : 'false',
            'isPrimaryGroup' => $this->isPrimaryGroup,
        ], fn ($v) => $v !== null && $v !== '');
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();

        $groups = [];
        if (isset($data['OuLists']) && is_array($data['OuLists'])) {
            foreach ($data['OuLists'] as $item) {
                $groups[] = new GroupSearchResponse(
                    name: $item['GROUP_NAME'] ?? '',
                    distinguishedName: $item['DISTINGUISHED_NAME'] ?? '',
                    sAMAccountName: $item['SAM_ACCOUNT_NAME'] ?? '',
                    manager: $item['MANAGER'] ?? '',
                    groupType: $item['GROUP_TYPE'] ?? '',
                );
            }
        }

        return $groups;
    }
}
