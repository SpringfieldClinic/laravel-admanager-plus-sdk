<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\OU;

class CreateOuResponse
{
    public function __construct(
        public readonly string $status = '',
        public readonly string $statusMessage = '',
        public readonly string $name = '',
    ) {}

}
