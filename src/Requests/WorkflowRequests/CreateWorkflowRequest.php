<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\Requests\WorkflowRequests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class CreateWorkflowRequest extends Request
{
    protected Method $method = Method::POST;

    public function __construct(protected array $inputFormat) {}

    public function resolveEndpoint(): string
    {
        return '/CreateWorkflowRequest';
    }

    public function defaultBody(): array
    {
        return ['inputFormat' => $this->inputFormat];
    }
}
