<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\Requests\OUManagement;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\OU\CreateOuResponse;

class CreateOuRequest extends Request
{
    protected Method $method = Method::POST;

    public function __construct(
        protected string $inputFormat = '',
    ) {}

    public function resolveEndpoint(): string
    {
        return '/CreateOU';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'inputFormat' => $this->inputFormat,
        ], fn ($v) => $v !== null && $v !== '');
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();

        return new CreateOuResponse(
            status: $data['status'] ?? '',
            statusMessage: $data['statusMessage'] ?? '',
            name: $data['USER_NAME'] ?? '',
        );
    }
}
