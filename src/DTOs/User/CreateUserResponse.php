<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\User;

class CreateUserResponse
{
    public function __construct(
        public readonly string $status = '',
        public readonly string $statusMessage = '',
        public readonly string $logOnName = '',
        public readonly string $username = '',
        public readonly string $password = '',
    ) {}
}