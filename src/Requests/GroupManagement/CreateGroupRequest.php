<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\Requests\GroupManagement;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\Group\CreateGroupResponse;

class CreateGroupRequest extends Request
{
    protected Method $method = Method::POST;

    public function __construct(
        protected string $inputFormat = '',
    ) {}

    public function resolveEndpoint(): string
    {
        return '/CreateGroup';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'inputFormat' => $this->inputFormat,
        ], fn($v) => $v !== null && $v !== '');
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
