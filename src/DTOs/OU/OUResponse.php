<?php

namespace SpringfieldClinic\LaravelAdmanagerPlusSdk\DTOs\OU;

class OUResponse
{
    public function __construct(
        public readonly string $ouName = '',
        public readonly string $distinguishedName = '',
        public readonly string $city = '',
        public readonly string $country = '',
        public readonly string $stateProvince = '',
        public readonly string $objectGuid = '',
        public readonly string $manager = '',
        public readonly string $name = '',
    ) {}
}
