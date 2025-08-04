<?php

namespace SpringfieldClinic\LaravelAdmanagerPlusSdk\DTOs\User;

class AddUserToGroupResponse
{
    public function __construct(
        public readonly string $status = '',
        public readonly string $statusMessage = '',
        public readonly string $sAMAccountName = '',
        public readonly string $userPrincipalName = '',
    ) {}
}
