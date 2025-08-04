<?php

namespace SpringfieldClinic\LaravelAdmanagerPlusSdk\Resources;

use Saloon\Http\BaseResource;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\DTOs\Workflow\WorkflowResponse;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\Requests\WorkflowRequests\CreateWorkflowRequest;

class WorkflowResource extends BaseResource
{
    public function create(array $inputFormat): WorkflowResponse
    {
        $response = $this->connector->send(new CreateWorkflowRequest($inputFormat));

        return new WorkflowResponse($response->json());
    }
}
