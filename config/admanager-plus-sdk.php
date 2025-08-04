<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Base API URL
    |--------------------------------------------------------------------------
    | The full base URL to your ADManager Plus REST API (e.g.
    | http://hostname:8080/RestAPI). Leave null to set via ENV.
    */
    'BASE_API_URL' => env('ADMANAGER_PLUS_BASE_API_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Active Directory Domain Name
    |--------------------------------------------------------------------------
    | The domain that ADManager Plus will target by default.
    */
    'domainName' => env('ADMANAGER_PLUS_DOMAIN_NAME', null),

    /*
    |--------------------------------------------------------------------------
    | Authorization Token
    |--------------------------------------------------------------------------
    | A valid AuthToken generated in ADManager Plus (Delegation → Technician Authtokens).
    */
    'AuthToken' => env('ADMANAGER_PLUS_AUTH_TOKEN', null),

    /*|--------------------------------------------------------------------------
    | Product Name
    |--------------------------------------------------------------------------
    | The product name to use in the API requests. Defaults to 'RESTAPI'.
    | This can be useful for identifying the source of API requests in audit/logs.
    */
    'PRODUCT_NAME' => env('ADMANAGER_PLUS_PRODUCT_NAME', 'RESTAPI'),
];
