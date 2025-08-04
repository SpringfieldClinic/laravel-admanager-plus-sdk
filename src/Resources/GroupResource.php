<?php

namespace SpringfieldClinic\LaravelAdmanagerPlusSdk\Resources;

use Saloon\Http\BaseResource;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\Requests\GroupManagement\CreateGroupRequest;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\Requests\GroupManagement\ListGroupMembersRequest;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\Requests\GroupManagement\MoveGroupRequest;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\Requests\GroupManagement\SearchGroupRequest;

class GroupResource extends BaseResource
{
    /**
     * Search for groups in Active Directory.
     *
     * @param  string  $searchText  The text to search for in group names.
     * @param  int  $range  The number of results to return.
     * @param  int  $startIndex  The index to start the search from.
     * @param  bool  $refresh  Whether to refresh the search results.
     * @param  bool  $isPrimaryGroup  Whether to filter by primary groups only.
     *
     * @throws FatalRequestException
     * @throws RequestException
     * @throws LogicException
     */
    public function search(
        string $searchText = '',
        int $range = 100,
        int $startIndex = 1,
        bool $refresh = false,
        bool $isPrimaryGroup = false,
    ): mixed {
        return $this->connector->send(new SearchGroupRequest(
            searchText: $searchText,
            range: $range,
            startIndex: $startIndex,
            refresh: $refresh,
            isPrimaryGroup: $isPrimaryGroup
        ))->dtoOrFail();
    }

    /**
     * Create a new group in Active Directory.
     *
     * @param  array  $groups  A string formatted array of group identifiers, e.g. "sAMAccountName, objectGUID, objectSID".
     *
     * @throws FatalRequestException
     * @throws RequestException
     * @throws LogicException
     */
    public function create(
        array $groups = [],
    ): mixed {
        return $this->connector->send(new CreateGroupRequest(
            groups: $groups,
        ))->dtoOrFail();
    }

    /**
     * Move a group to a different Organizational Unit (OU) in Active Directory.
     *
     * @param  array  $groups  A string formatted array of group identifiers, e.g. "sAMAccountName, objectGUID, objectSID".
     * @param  string  $targetOU  The distinguished name of the target OU where the group should be moved.
     *
     * @throws FatalRequestException
     * @throws RequestException
     * @throws LogicException
     */
    public function move(
        array $groups = [],
        string $targetOU = '',
    ): mixed {
        return $this->connector->send(new MoveGroupRequest(
            groups: $groups,
            targetOU: $targetOU,
        ))->dtoOrFail();
    }

    /**
     * List members of a group in Active Directory.
     *
     * @param  array  $groups  A string formatted array of group identifiers, e.g. "sAMAccountName, objectGUID, objectSID".
     * @param  bool  $refresh  Whether to refresh the member list.
     *
     * @throws FatalRequestException
     * @throws RequestException
     * @throws LogicException
     */
    public function listMembers(
        array $groups = [],
        bool $refresh = false,
    ): mixed {
        return $this->connector->send(new ListGroupMembersRequest(
            groups: $groups,
            refresh: $refresh,
        ))->dtoOrFail();
    }
}
