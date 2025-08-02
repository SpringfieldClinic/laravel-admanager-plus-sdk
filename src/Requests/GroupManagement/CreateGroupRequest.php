<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\Requests\GroupManagement;

use Saloon\Enums\Method;
use Saloon\Http\Response;
use SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\Group\CreateGroupResponse;
use SpringfieldClinic\LaravelADManagerPlusSDK\Requests\BaseRequest;

class CreateGroupRequest extends BaseRequest
{
    protected Method $method = Method::POST;

    public function __construct(
        protected array $groups = [],
    ) {}

    public function resolveEndpoint(): string
    {
        return '/CreateGroup';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'inputFormat' => $this->buildInputFormatString(
                requiredFields: [
                    'name', // e.g., 'My New Group'
                    'sAMAccountName', // e.g., 'My New Group'
                    'groupType', // e.g., 'Security' or 'Distribution'
                    'groupScope', // e.g., 'Global', 'DomainLocal', or 'Universal'
                    'OUName', // FQDN of the OU where the group will be created
                ],
                data: $this->groups
            ),
        ], fn ($v) => $v !== null && $v !== '');
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();

        return new CreateGroupResponse(
            status: $data['status'] ?? '',
            statusMessage: $data['statusMessage'] ?? '',
            ouName: $data['OU Name'] ?? '',
            name: $data['Name'] ?? ''
        );
    }
}
