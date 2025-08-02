<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\Resources;

use LogicException;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use SpringfieldClinic\LaravelADManagerPlusSDK\Requests\UserManagement\AddUserToGroupRequest;
use SpringfieldClinic\LaravelADManagerPlusSDK\Requests\UserManagement\CreateUserRequest;
use SpringfieldClinic\LaravelADManagerPlusSDK\Requests\UserManagement\DisableUserRequest;
use SpringfieldClinic\LaravelADManagerPlusSDK\Requests\UserManagement\EnableUserRequest;
use SpringfieldClinic\LaravelADManagerPlusSDK\Requests\UserManagement\MoveUserRequest;
use SpringfieldClinic\LaravelADManagerPlusSDK\Requests\UserManagement\RemoveUserFromGroupRequest;
use SpringfieldClinic\LaravelADManagerPlusSDK\Requests\UserManagement\ResetUserPasswordRequest;
use SpringfieldClinic\LaravelADManagerPlusSDK\Requests\UserManagement\SearchUserRequest;
use SpringfieldClinic\LaravelADManagerPlusSDK\Requests\UserManagement\UnlockUserRequest;
use SpringfieldClinic\LaravelADManagerPlusSDK\Requests\UserManagement\UpdateUserRequest;

class UserResource extends BaseResource
{
    /**
     * Search for users in Active Directory.
     *
     * @param  string  $searchText  The text to search for in user attributes.
     * @param  int  $range  The number of results to return, defaults to 10.
     * @param  int  $startIndex  The index to start the search from, defaults to 1.
     * @param  bool  $refresh  Whether the server will refresh & update the changes in AD in ADManager Plus, and then send the updated results, defaults to false.
     * @param  string  $sortColumn  The column to sort the results by, defaults to empty (no sorting).
     * @param  bool  $ascending  Whether the sort order is ascending, defaults to true.
     * @param  string  $select  A comma-separated list of LDAP attributes to select, defaults to empty (all attributes).
     * @param  string  $filter  A filter expression to apply to the search, defaults to empty (no filter). The filter parameter format: (<LDAP/special key>:<operator>:<value>), e.g. '(givenName:contains:john)'. Operators: equal, equalCaseSensitive, notEqual, greaterThan, greaterEqual, lessThan, lessEqual , endsWith, notEndsWith, startsWith, notStartsWith, contains, notContains, like and notLike. You can use multiple filters by connecting them with the logical operators 'and' or 'or'. For example: '(givenName:contains:john)and(sn:contains:doe)'.
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function search(
        string $searchText = '',
        int $range = 100,
        int $startIndex = 1,
        bool $refresh = false,
        string $sortColumn = '',
        bool $ascending = true,
        string $select = '',
        string $filter = ''
    ): mixed {
        return $this->connector->send(new SearchUserRequest(
            searchText: $searchText,
            range: $range,
            startIndex: $startIndex,
            refresh: $refresh,
            sortColumn: $sortColumn,
            ascending: $ascending,
            select: $select,
            filter: $filter
        ))->dtoOrFail();
    }

    /**
     * Create a new user in Active Directory.
     *
     * @param  array  $users  An array of user data to create. Each user should be an associative array with keys like 'userPrincipalName', 'sAMAccountName', 'givenName', 'sn', 'displayName', 'mail', etc. The required fields depend on your Active Directory schema.
     * 
     *  Example user data structure:
     * [
     *   'givenName' => '', // The user's first name
     *   'initials' => '', // The user's middle name/initials
     *   'sn' => '', // The user's last name/surname
     *   'userPrincipalName' => '', // The user's logon name
     *   'sAMAccountName' => '', // The user's logon name (legacy pre Windows 2000)
     *   'displayName' => '', // The user's display name
     *   'description' => '', // A description for the user
     *   'physicalDeliveryOfficeName' => '', // The user's office location
     *   'telephoneNumber' => '', // The user's telephone number
     *   'mobile' => '', // The user's mobile number
     *   'mail' => '', // The user's email address
     *   'password' => '', // The user's password
     *   'street' => '', // The user's street address
     *   'city' => '', // The user's city
     *   'state' => '', // The user's state
     *   'postalCode' => '', // The user's postal code
     *   'country' => '', // The user's country
     *   'title' => '', // The user's job title
     *   'department' => '', // The user's department
     *   'company' => '', // The user's company
     *   'manager' => '', // The user's manager (can be a distinguished name or sAMAccountName)
     *   'employeeID' => '', // The user's employee ID
     *   'extensionAttribute1' => '', // Custom extension attributes (1-15)
     *   'extensionAttribute2' => '', // Custom extension attributes (1-15)
     *   'extensionAttribute3' => '', // Custom extension attributes (1-15)
     *   'extensionAttribute4' => '', // Custom extension attributes (1-15)
     *   'extensionAttribute5' => '', // Custom extension attributes (1-15)
     *   'extensionAttribute6' => '', // Custom extension attributes (1-15)
     *   'extensionAttribute7' => '', // Custom extension attributes (1-15)
     *   'extensionAttribute8' => '', // Custom extension attributes (1-15)
     *   'extensionAttribute9' => '', // Custom extension attributes (1-15)
     *   'extensionAttribute10' => '', // Custom extension attributes (1-15)
     *   'extensionAttribute11' => '', // Custom extension attributes (1-15)
     *   'extensionAttribute12' => '', // Custom extension attributes (1-15)
     *   'extensionAttribute13' => '', // Custom extension attributes (1-15)
     *   'extensionAttribute14' => '', // Custom extension attributes (1-15)
     *   'extensionAttribute15' => '', // Custom extension attributes (1-15)
     * ]
     *
     * @throws FatalRequestException
     * @throws RequestException
     * @throws LogicException
     */
    public function create(
        array $users = [],
    ): mixed {
        return $this->connector->send(new CreateUserRequest(
            users: $users,
        ))->dtoOrFail();
    }

    /**
     * Enable a user account.
     *
     * @param  array  $users  An array of user data to create. Each user should be an associative array with keys like 'userPrincipalName'.
     * @param  string  $accountExpires  A string indicating when the account expires, defaults to 'Never'. Set to 'EndOf' if you want the set the account expirty time.
     * @param  string  $expireTime  A string indicating the exact time when the account expires, required if `accountExpires` is set to 'EndOf'. The format should be 'MM-dd-yyyy', e.g. '12-31-2023'. If `accountExpires` is set to 'Never', this parameter is ignored.
     *
     * @throws FatalRequestException
     * @throws RequestException
     * @throws LogicException
     */
    public function enable(
        array $users = [],
        string $accountExpires = 'Never',
        string $expireTime = ''
    ): mixed {
        return $this->connector->send(new EnableUserRequest(
            users: $users,
            accountExpires: $accountExpires,
            expireTime: $expireTime
        ))->dtoOrFail();
    }

    /**
     * Disable a user account.
     *
     * @param  array  $users  An array of user data to create. Each user should be an associative array with keys like 'userPrincipalName'.
     *
     * @throws FatalRequestException
     * @throws RequestException
     * @throws LogicException
     */
    public function disable(
        array $users = [],
    ): mixed {
        return $this->connector->send(new DisableUserRequest(
            users: $users,
        ))->dtoOrFail();
    }

    /**
     * Move a user to a different Organizational Unit (OU).
     *
     * @param  array   $users  An array of user data to create. Each user should be an associative array with keys like 'userPrincipalName'.
     * @param  string  $targetOU  The name of the OU to which the users are being moved.
     *
     * @throws FatalRequestException
     * @throws RequestException
     * @throws LogicException
     */
    public function move(
        array $users = [],
        string $targetOU = ''
    ): mixed {
        return $this->connector->send(new MoveUserRequest(
            users: $users,
            targetOU: $targetOU
        ))->dtoOrFail();
    }

    /**
     * Add a user to a group.
     *
     * @param  array   $users  An array of user data to create. Each user should be an associative array with keys like 'userPrincipalName'.
     * @param  string  $addGroup  A comma-separated list of group sAMAccountName names to add the user to.
     * @param  string  $primaryGroup  The primary group sAMAccountName for the user, defaults to empty (no primary group).
     *
     * @throws FatalRequestException
     * @throws RequestException
     * @throws LogicException
     */
    public function addGroup(
        array $users = [],
        string $addGroup = '',
        string $primaryGroup = ''
    ): AddUserToGroupRequest {
        return $this->connector->send(new AddUserToGroupRequest(
            users: $users,
            addGroup: $addGroup,
            primaryGroup: $primaryGroup
        ))->dtoOrFail();
    }

    /**
     * Remove a user from a group.
     *
     * @param  array   $users  An array of user data to create. Each user should be an associative array with keys like 'userPrincipalName'.
     * @param  string  $removeGroup  A comma-separated list of group sAMAccountName names to remove the user from.
     *
     * @throws FatalRequestException
     * @throws RequestException
     * @throws LogicException
     */
    public function removeGroup(
        array $users = [],
        string $removeGroup = ''
    ): mixed {
        return $this->connector->send(new RemoveUserFromGroupRequest(
            users: $users,
            removeGroup: $removeGroup
        ))->dtoOrFail();
    }

    /**
     * Update user attributes.
     *
     * @param  array   $users  An array of user data to create. Each user should be an associative array with keys like 'userPrincipalName'.
     * @param  string  $matchLdapName  The LDAP attribute to match the user by, defaults to empty (no specific match). The following are the attributes that can be specified along with this parameter: sAMAccountName, employeeID, userPrincipalName, distinguishedName, cn, name, givenName, sn, displayName, profilePath, scriptPath, employeeNumber, mail, objectSID, and objectGUID.
     *
     * @throws FatalRequestException
     * @throws RequestException
     * @throws LogicException
     */
    public function update(
        array $users = [],
        string $matchLdapName = '',
    ): mixed {
        return $this->connector->send(new UpdateUserRequest(
            users: $users,
            matchLdapName: $matchLdapName
        ))->dtoOrFail();
    }

    /**
     * Reset a user's password.
     *
     * @param  array   $users  An array of user data to create. Each user should be an associative array with keys like 'userPrincipalName'.
     * @param  string  $passwordType  The type of password to set, defaults to 'password'. Other options include 'random', 'temporary', and 'custom'.
     * @param  string  $pwd  The new password to set for the user, required if `passwordType` is set to 'custom'.
     * @param  bool  $mustChangePassword  Whether the user must change their password at next login, defaults to false.
     *
     * @throws FatalRequestException
     * @throws RequestException
     * @throws LogicException
     */
    public function resetPassword(
        array $users = [],
        string $passwordType = 'password',
        string $pwd = '',
    ): mixed {
        return $this->connector->send(new ResetUserPasswordRequest(
            users: $users,
            passwordType: $passwordType,
            pwd: $pwd,
        ))->dtoOrFail();
    }

    /**
     * Unlock a user account.
     *
     * @param  array  $users  An array of user data to create. Each user should be an associative array with keys like 'userPrincipalName'.
     *
     * @throws FatalRequestException
     * @throws RequestException
     * @throws LogicException
     */
    public function unlock(
        array $users = [],
    ): mixed {
        return $this->connector->send(new UnlockUserRequest(
            users: $users,
        ))->dtoOrFail();
    }
}
