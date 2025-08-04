<?php

namespace SpringfieldClinic\LaravelAdmanagerPlusSdk\DTOs\User;

class UserSearchResponse
{
    public function __construct(
        public readonly string $status = '',
        public readonly string $statusMessage = '',
        public readonly int $count = 0,
        public readonly array $users = [],
    ) {}
}
