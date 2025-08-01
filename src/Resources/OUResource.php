<?php

namespace SpringfieldClinic\LaravelADManagerPlusSDK\Resources;

use Saloon\Http\BaseResource;
use SpringfieldClinic\LaravelADManagerPlusSDK\Requests\OUManagement\CreateOuRequest;
use SpringfieldClinic\LaravelADManagerPlusSDK\Requests\OUManagement\SearchOURequest;

class OUResource extends BaseResource
{
    /**
     * Search for users in Active Directory.
     * @param string $searchText The text to search for in user attributes.
     * @param int $range The number of results to return, defaults to 10.
     * @param int $startIndex The index to start the search from, defaults to 1.
     * @param bool $refresh Whether the server will refresh & update the changes in AD in ADManager Plus, and then send the updated results, defaults to false.
     * @param string $sortColumn The column to sort the results by, defaults to empty (no sorting).
     * @param bool $ascending Whether the sort order is ascending, defaults to true.
     * @param string $select A comma-separated list of LDAP attributes to select, defaults to empty (all attributes).
     * @param string $filter A filter expression to apply to the search, defaults to empty (no filter). The filter parameter format: (<LDAP/special key>:<operator>:<value>), e.g. '(givenName:contains:john)'. Operators: equal, equalCaseSensitive, notEqual, greaterThan, greaterEqual, lessThan, lessEqual , endsWith, notEndsWith, startsWith, notStartsWith, contains, notContains, like and notLike. You can use multiple filters by connecting them with the logical operators 'and' or 'or'. For example: '(givenName:contains:john)and(sn:contains:doe)'.
     * @return mixed 
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
        return $this->connector->send(new SearchOuRequest(
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
     * Create a new Organizational Unit (OU) in Active Directory.
     * @param string $inputFormat A string formatted array of OU identifiers. e.g. [{"name":"testBOU5", "OUName":"OU=test,DC=mse1,DC=com"}] will create the OU "testBOU5" with the distinguished name "OU=test,DC=mse1,DC=com". The OUName is the distinguished name of the parent OU that the new OU will be created under.
     * @return mixed 
     * @throws FatalRequestException 
     * @throws RequestException 
     */
    public function create(
        string $inputFormat = '',
    ): mixed {
        return $this->connector->send(new CreateOuRequest(
            inputFormat: $inputFormat,
        ))->dtoOrFail();
    }
}