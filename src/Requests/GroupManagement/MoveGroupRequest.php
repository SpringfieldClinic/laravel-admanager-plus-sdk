<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\Requests\GroupManagement;

use Saloon\Enums\Method;
use Saloon\Http\Response;
use SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\Group\MoveGroupResponse;
use SpringfieldClinic\LaravelADManagerPlusSDK\Requests\BaseRequest;

class MoveGroupRequest extends BaseRequest
{
    protected Method $method = Method::POST;

    public function __construct(
        protected array $groups = [],
        protected string $targetOU = '',
    ) {}

    public function resolveEndpoint(): string
    {
        return '/MoveGroup';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'inputFormat' => $this->buildInputFormatString(
                requiresOneOfFields: [
                    'sAMAccountName', // e.g., 'My Group'
                    'objectGUID', // e.g., '12345678-1234-1234-1234-123456789012'
                    'objectSID', // e.g., 'S-1-5-21-1234567890-1234567890-1234567890-1234'
                ],
                data: $this->groups
            ),
            'destination' => $this->targetOU,
        ], fn ($v) => $v !== null && $v !== '');
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();

        return new MoveGroupResponse(
            sAMAccountName: $data['sAMAccountName'] ?? '',
            status: $data['status'] ?? '',
            statusMessage: $data['statusMessage'] ?? '',
        );
    }
}
