<?php

namespace SpringfieldClinic\LaravelAdmanagerPlusSdk\DTOs\User;

class UnlockUserResponse
{
    public function __construct(
        public readonly string $userPrincipalName = '',
        public readonly string $sAMAccountName = '',
        public readonly string $objectSID = '',
        public readonly string $statusMessage = ''
    ) {}
}
