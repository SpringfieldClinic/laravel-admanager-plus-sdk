<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\Requests\GroupManagement;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\Group\ListGroupMembersResponse;
use SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\Group\ListMembersResponse;

class ListGroupMembersRequest extends Request
{
    protected Method $method = Method::POST;

    public function __construct(
        protected string $inputFormat = '',
        protected bool $refresh = false,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/ListGroupMembers';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'inputFormat' => $this->inputFormat,
            'refresh' => $this->refresh ? 'true' : 'false',
        ], fn ($v) => $v !== null && $v !== '');
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();

        $groups = [];
        if (is_array($data)) {
            foreach ($data as $group) {
                $members = [];
                if (isset($group['members']) && is_array($group['members'])) {
                    $members['count'] = $group['members']['Count'] ?? 0;

                    foreach ($group['members']['Users'] as $member) {
                        $members['users'][] = new ListMembersResponse(
                            sAMAccountName: $member['sAMAccountName'] ?? '',
                            domainName: $member['domainName'] ?? '',
                        );
                    }
                }

                $groups[] = new ListGroupMembersResponse(
                    sAMAccountName: $group['sAMAccountName'] ?? '',
                    memberCount: count($members) ?? 0,
                    members: $members
                );
            }
        }

        return $groups;
    }
}
