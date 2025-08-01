<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\DTOs\Group;

class CreateGroupResponse
{
    public function __construct(
        public readonly string $status = '',
        public readonly string $statusMessage = '',
        public readonly string $ouName = '',
        public readonly string $name = ''
    ) {}
}
