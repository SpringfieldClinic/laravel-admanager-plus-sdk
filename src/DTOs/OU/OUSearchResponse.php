<?php

namespace SpringfieldClinic\LaravelAdmanagerPlusSdk\DTOs\OU;

class OUSearchResponse
{
    public function __construct(
        public readonly string $status = '',
        public readonly string $statusMessage = '',
        public readonly int $count = 0,
        public readonly array $ous = [],
    ) {}

}
