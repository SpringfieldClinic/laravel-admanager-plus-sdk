<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\Requests;

use Saloon\Http\Request;

class BaseRequest extends Request
{
    public function resolveEndpoint(): string
    {
        return '/';
    }

    /**
     * Build the input format string for the request.
     *
     * @param array $data
     * @return string
     */
    public function buildInputFormatString(
        array $requiredFields = [],
        array $requiresOneOfFields = [],
        array $data = []
    ): string {
        // Ensure the input data is not empty
        if (empty($data)) {
            throw new \InvalidArgumentException('Input data cannot be empty.');
        }

        // Ensure the data contains all requiredFields
        if (!empty($requiredFields)) {
            foreach ($requiredFields as $field) {
                if (!array_key_exists($field, $data)) {
                    throw new \InvalidArgumentException("Missing required field: {$field}. The required fields are: " . implode(', ', $requiredFields));
                }
            }
        }

        // Ensure the data contains at least one of the requiresOneOf fields
        if (!empty($requiresOneOfFields)) {
            if (empty(array_intersect(array_keys($data), $requiresOneOfFields))) {
                throw new \InvalidArgumentException("At least one of the following fields is required: " . implode(', ', $requiresOneOfFields));
            }
        }

        $formattedData = [];
        foreach ($data as $key => $value) {
            // Ensure the key is a valid Active Directory attribute
            if (in_array($key, [
                'userPrincipalName',
                'sAMAccountName',
                'givenName',
                'sn',
                'displayName',
                'description',
                'physicalDeliveryOfficeName',
                'telephoneNumber',
                'mobile',
                'mail',
                'password',
                'street',
                'city',
                'state',
                'postalCode',
                'country',
                'title',
                'department',
                'company',
                'objectGUID',
                'objectSID',
                'manager',
                'employeeID',
                'employeeNumber',
                'profilePath',
                'scriptPath',
                'homeDirectory',
                'homeDrive',
                'accountExpires',
                'expireTime',
                'enabled',
                'passwordNeverExpires',
                'mustChangePassword',
                'userAccountControl',
                'lastLogon',
                'lastLogoff',
                'logonCount',
                'badLogonCount',
                'lastPasswordChange',
                'lastLogonTimestamp',
                'lastLogonDate',
                'lastLogoffDate',
                'lastPasswordSet',
                'lastLogonTimeStamp',
                'lastLogonDateTime',
                'lastLogoffDateTime',
                'lastPasswordChangeDateTime',
                'lastLogonTimestampDateTime',
                
                'groupType',
                'groupScope',
                'OUName',
            ])) {
                // Format the value based on its type
                if (is_string($value)) {
                    // Trim whitespace and ensure it's not empty
                    $formattedValue = trim($value);
                } elseif (is_int($value) || is_float($value)) {
                    // Ensure numeric values are formatted correctly
                    $formattedValue = (string)$value;
                }
            } else {
                // Throw an exception if the key is not a valid Active Directory attribute
                throw new \InvalidArgumentException("Invalid Active Directory attribute: {$key}");
            }

            $formattedData[$key] = $formattedValue;
        }


        return json_encode(
            array_map('urlencode', $formattedData)
        );
    }
}
