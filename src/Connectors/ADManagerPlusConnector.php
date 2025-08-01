<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\Connectors;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use SpringfieldClinic\LaravelADManagerPlusSDK\Resources\UserResource;
use SpringfieldClinic\LaravelADManagerPlusSDK\Resources\GroupResource;
use SpringfieldClinic\LaravelADManagerPlusSDK\Resources\ComputerResource;
use SpringfieldClinic\LaravelADManagerPlusSDK\Resources\OUResource;
use SpringfieldClinic\LaravelADManagerPlusSDK\Resources\DomainResource;
use SpringfieldClinic\LaravelADManagerPlusSDK\Resources\WorkflowResource;

class ADManagerPlusConnector extends Connector
{
    use AcceptsJson;

    public function resolveBaseUrl(): string
    {
        return config('laravel-admanager-plus-sdk.BASE_API_URL') ?? '';
    }

    protected function defaultQuery(): array
    {
        return array_filter([
            'AuthToken'  => config('laravel-admanager-plus-sdk.AuthToken'),
            'domainName' => config('laravel-admanager-plus-sdk.domainName'),
            'PRODUCT_NAME' => config('laravel-admanager-plus-sdk.PRODUCT_NAME'),
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
