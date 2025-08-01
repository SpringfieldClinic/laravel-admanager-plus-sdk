<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\Group;

class GroupSearchResponse
{
    public function __construct(
        public readonly string $name = '',
        public readonly string $distinguishedName = '',
        public readonly string $sAMAccountName = '',
        public readonly string $manager = '',
        public readonly string $groupType = ''
    ) {}
}
