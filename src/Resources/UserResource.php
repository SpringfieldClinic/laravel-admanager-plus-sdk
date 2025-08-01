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
     * @param  string  $inputFormat  A string formatted array of user identifiers, e.g. "userPrincipalName, sAMAccountName, objectGUID, objectSID".
     *
     * @throws FatalRequestException
     * @throws RequestException
     * @throws LogicException
     */
    public function create(
        string $inputFormat = '',
    ): mixed {
        return $this->connector->send(new CreateUserRequest(
            inputFormat: $inputFormat,
        ))->dtoOrFail();
    }

    /**
     * Enable a user account.
     *
     * @param  string  $inputFormat  A string formatted array of user identifiers, e.g. "userPrincipalName, sAMAccountName, objectGUID, objectSID".
     * @param  string  $accountExpires  A string indicating when the account expires, defaults to 'Never'. Set to 'EndOf' if you want the set the account expirty time.
     * @param  string  $expireTime  A string indicating the exact time when the account expires, required if `accountExpires` is set to 'EndOf'. The format should be 'MM-dd-yyyy', e.g. '12-31-2023'. If `accountExpires` is set to 'Never', this parameter is ignored.
     *
     * @throws FatalRequestException
     * @throws RequestException
     * @throws LogicException
     */
    public function enable(
        string $inputFormat = '',
        string $accountExpires = 'Never',
        string $expireTime = ''
    ): mixed {
        return $this->connector->send(new EnableUserRequest(
            inputFormat: $inputFormat,
            accountExpires: $accountExpires,
            expireTime: $expireTime
        ))->dtoOrFail();
    }

    /**
     * Disable a user account.
     *
     * @param  string  $inputFormat  A string formatted array of user identifiers, e.g. "userPrincipalName, sAMAccountName, objectGUID, objectSID".
     *
     * @throws FatalRequestException
     * @throws RequestException
     * @throws LogicException
     */
    public function disable(
        string $inputFormat = '',
    ): mixed {
        return $this->connector->send(new DisableUserRequest(
            inputFormat: $inputFormat,
        ))->dtoOrFail();
    }

    /**
     * Move a user to a different Organizational Unit (OU).
     *
     * @param  string  $inputFormat  A string formatted array of user identifiers, e.g. "userPrincipalName, sAMAccountName, objectGUID, objectSID".
     * @param  string  $targetOU  The name of the OU to which the users are being moved.
     *
     * @throws FatalRequestException
     * @throws RequestException
     * @throws LogicException
     */
    public function move(
        string $inputFormat = '',
        string $targetOU = ''
    ): mixed {
        return $this->connector->send(new MoveUserRequest(
            inputFormat: $inputFormat,
            targetOU: $targetOU
        ))->dtoOrFail();
    }

    /**
     * Add a user to a group.
     *
     * @param  string  $inputFormat  A string formatted array of user identifiers, e.g. "userPrincipalName, sAMAccountName, objectGUID, objectSID".
     * @param  string  $addGroup  A comma-separated list of group sAMAccountName names to add the user to.
     * @param  string  $primaryGroup  The primary group sAMAccountName for the user, defaults to empty (no primary group).
     *
     * @throws FatalRequestException
     * @throws RequestException
     * @throws LogicException
     */
    public function addGroup(
        string $inputFormat = '',
        string $addGroup = '',
        string $primaryGroup = ''
    ): AddUserToGroupRequest {
        return $this->connector->send(new AddUserToGroupRequest(
            inputFormat: $inputFormat,
            addGroup: $addGroup,
            primaryGroup: $primaryGroup
        ))->dtoOrFail();
    }

    /**
     * Remove a user from a group.
     *
     * @param  string  $inputFormat  A string formatted array of user identifiers, e.g. "userPrincipalName, sAMAccountName, objectGUID, objectSID".
     * @param  string  $removeGroup  A comma-separated list of group sAMAccountName names to remove the user from.
     *
     * @throws FatalRequestException
     * @throws RequestException
     * @throws LogicException
     */
    public function removeGroup(
        string $inputFormat = '',
        string $removeGroup = ''
    ): mixed {
        return $this->connector->send(new RemoveUserFromGroupRequest(
            inputFormat: $inputFormat,
            removeGroup: $removeGroup
        ))->dtoOrFail();
    }

    /**
     * Update user attributes.
     *
     * @param  string  $inputFormat  A string formatted array of user identifiers, e.g. "userPrincipalName, sAMAccountName, objectGUID, objectSID".
     * @param  string  $matchLdapName  The LDAP attribute to match the user by, defaults to empty (no specific match). The following are the attributes that can be specified along with this parameter: sAMAccountName, employeeID, userPrincipalName, distinguishedName, cn, name, givenName, sn, displayName, profilePath, scriptPath, employeeNumber, mail, objectSID, and objectGUID.
     *
     * @throws FatalRequestException
     * @throws RequestException
     * @throws LogicException
     */
    public function update(
        string $inputFormat = '',
        string $matchLdapName = '',
    ): mixed {
        return $this->connector->send(new UpdateUserRequest(
            inputFormat: $inputFormat,
            matchLdapName: $matchLdapName
        ))->dtoOrFail();
    }

    /**
     * Reset a user's password.
     *
     * @param  string  $inputFormat  A string formatted array of user identifiers, e.g. "userPrincipalName, sAMAccountName, objectGUID, objectSID".
     * @param  string  $passwordType  The type of password to set, defaults to 'password'. Other options include 'random', 'temporary', and 'custom'.
     * @param  string  $pwd  The new password to set for the user, required if `passwordType` is set to 'custom'.
     * @param  bool  $mustChangePassword  Whether the user must change their password at next login, defaults to false.
     *
     * @throws FatalRequestException
     * @throws RequestException
     * @throws LogicException
     */
    public function resetPassword(
        string $inputFormat = '',
        string $passwordType = 'password',
        string $pwd = '',
    ): mixed {
        return $this->connector->send(new ResetUserPasswordRequest(
            inputFormat: $inputFormat,
            passwordType: $passwordType,
            pwd: $pwd,
        ))->dtoOrFail();
    }

    /**
     * Unlock a user account.
     *
     * @param  string  $inputFormat  A string formatted array of user identifiers, e.g. "userPrincipalName, sAMAccountName, objectGUID, objectSID".
     *
     * @throws FatalRequestException
     * @throws RequestException
     * @throws LogicException
     */
    public function unlock(
        string $inputFormat = '',
    ): mixed {
        return $this->connector->send(new UnlockUserRequest(
            inputFormat: $inputFormat,
        ))->dtoOrFail();
    }
}
