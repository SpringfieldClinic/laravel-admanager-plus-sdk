<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\User;

class MoveUserResponse
{
    public function __construct(
        public readonly string $destinationOUName = '',
        public readonly string $sAMAccountName = '',
        public readonly string $objectGUID = '',
        public readonly string $objectSID = '',
        public readonly string $distinguishedName = '',
        public readonly string $userPrincipalName = '',
        public readonly string $ouName = '',
        public readonly string $statusMessage = '',
        public readonly string $status = ''
    ) {}
}
