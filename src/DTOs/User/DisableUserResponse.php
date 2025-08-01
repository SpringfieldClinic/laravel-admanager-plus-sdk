<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\User;

class DisableUserResponse
{
    public function __construct(
        public readonly string $userPrincipalName = '',
        public readonly string $sAMAccountName = '',
        public readonly string $objectSID = '',
        public readonly string $statusMessage = '',
    ) {}
}