<?php

namespace SpringfieldClinic\LaravelAdmanagerPlusSdk\DTOs\User;

class UserResponse
{
    public function __construct(
        public readonly string $logonName = '',
        public readonly string $distinguishedName = '',
        public readonly string $employeeId = '',
        public readonly string $initial = '',
        public readonly string $lastName = '',
        public readonly string $domainName = '',
        public readonly string $firstName = '',
        public readonly string $displayName = '',
        public readonly string $ouName = '',
        public readonly string $city = '',
        public readonly string $country = '',
        public readonly string $emailAddress = '',
        public readonly string $sidString = '',
        public readonly string $objectGuid = '',
        public readonly string $streetAddress = '',
        public readonly string $mobile = '',
        public readonly string $samAccountName = '',
    ) {}
}
