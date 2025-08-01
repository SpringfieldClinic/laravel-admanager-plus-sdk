<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\Requests\GroupManagement;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\Group\MoveGroupResponse;

class MoveGroupRequest extends Request
{
    protected Method $method = Method::POST;

    public function __construct(
        protected string $inputFormat = '',
        protected string $targetOU = '',
    ) {}

    public function resolveEndpoint(): string
    {
        return '/MoveGroup';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'inputFormat' => $this->inputFormat,
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
