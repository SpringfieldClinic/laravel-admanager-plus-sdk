<?php

namespace SpringfieldClinic\LaravelAdmanagerPlusSdk\DTOs\User;

class RemoveUserFromGroupResponse
{
    public function __construct(
        public readonly string $status = '',
        public readonly string $statusMessage = '',
        public readonly string $sAMAccountName = '',
        public readonly string $userPrincipalName = '',
    ) {}
}
