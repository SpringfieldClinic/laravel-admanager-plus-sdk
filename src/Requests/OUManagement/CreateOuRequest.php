<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\Requests\OUManagement;

use Saloon\Enums\Method;
use Saloon\Http\Response;
use SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\OU\CreateOuResponse;
use SpringfieldClinic\LaravelADManagerPlusSDK\Requests\BaseRequest;

class CreateOuRequest extends BaseRequest
{
    protected Method $method = Method::POST;

    public function __construct(
        protected array $ous = [],
    ) {}

    public function resolveEndpoint(): string
    {
        return '/CreateOU';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'inputFormat' => $this->buildInputFormatString(
                requiredFields: [
                    'name', // e.g., 'My New OU'
                    'OUName', // FQDN of the parent OU where the OU will be created
                ],
                data: $this->ous
            ),
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
