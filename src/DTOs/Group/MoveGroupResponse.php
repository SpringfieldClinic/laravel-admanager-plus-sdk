<?php

namespace SpringfieldClinic\LaravelAdmanagerPlusSdk\DTOs\Group;

class MoveGroupResponse
{
    public function __construct(
        public readonly string $sAMAccountName = '',
        public readonly string $status = '',
        public readonly string $statusMessage = '',
    ) {}
}
