<?php

namespace SpringfieldClinic\LaravelAdmanagerPlusSdk\Connectors;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\Resources\GroupResource;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\Resources\OUResource;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\Resources\UserResource;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\Resources\WorkflowResource;

class ADManagerPlusConnector extends Connector
{
    use AcceptsJson;

    public function resolveBaseUrl(): string
    {
        return config('admanager-plus-sdk.BASE_API_URL') ?? '';
    }

    public function defaultConfig(): array
    {
        return [
            'verify' => false,
        ];
    }

    protected function defaultQuery(): array
    {
        return array_filter([
            'AuthToken' => config('admanager-plus-sdk.AuthToken'),
            'domainName' => config('admanager-plus-sdk.domainName'),
            'PRODUCT_NAME' => config('admanager-plus-sdk.PRODUCT_NAME'),
        ]);
    }

    public function users(): UserResource
    {
        return new UserResource($this);
    }

    public function groups(): GroupResource
    {
        return new GroupResource($this);
    }

    public function ous(): OUResource
    {
        return new OUResource($this);
    }

    public function workflows(): WorkflowResource
    {
        return new WorkflowResource($this);
    }
}
