<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\Workflow;

class WorkflowResponse
{
    public function __construct(protected array $payload) {}

    public function status(): string
    {
        return $this->payload['status'] ?? '';
    }

    public function requestId(): ?string
    {
        return $this->payload['requestId'] ?? null;
    }
}
