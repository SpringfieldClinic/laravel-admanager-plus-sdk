<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\Group;

class ListGroupMembersResponse
{
    public function __construct(
        public readonly string $sAMAccountName = '',
        public readonly int $memberCount = 0,
        public readonly array $members = [],
    ) {}
}