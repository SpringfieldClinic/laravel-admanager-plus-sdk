<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\Group;

class ListMembersResponse
{
    public function __construct(
        public readonly string $sAMAccountName = '',
        public readonly string $domainName = '',
    ) {}
}
