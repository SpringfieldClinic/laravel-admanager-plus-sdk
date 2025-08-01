<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\Resources;

use Saloon\Http\BaseResource;
use SpringfieldClinic\LaravelADManagerPlusSDK\Requests\WorkflowRequests\CreateWorkflowRequest;
use SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\Workflow\WorkflowResponse;

class WorkflowResource extends BaseResource
{
    public function create(array $inputFormat): WorkflowResponse
    {
        $response = $this->connector->send(new CreateWorkflowRequest($inputFormat));
        return new WorkflowResponse($response->json());
    }
}