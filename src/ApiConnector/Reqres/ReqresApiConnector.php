<?php

namespace App\ApiConnector\Reqres;

use App\Library\Artcustomer\ApiUnit\Connector\AbstractApiGateway;
use App\Library\Artcustomer\ApiUnit\Http\IApiResponse;
use App\Library\Artcustomer\ApiUnit\Utils\ApiMethodTypes;
use App\ApiConnector\Reqres\Client\ApiClient;
use App\ApiConnector\Reqres\Utils\ApiInfos;
use App\ApiConnector\Reqres\Utils\ApiEndpoints;

/**
 * @author David
 */
class ReqresApiConnector extends AbstractApiGateway {

    /**
     * Constructor
     */
    public function __construct() {
        $this->defineParams();

        parent::__construct(ApiClient::class, [$this->params]);
    }

    /**
     * Initialize
     * 
     * @return void
     */
    public function initialize(): void {
        $this->client->initialize();
    }

    /**
     * Test API
     * 
     * @return IApiResponse
     */
    public function test(): IApiResponse {
        return $this->client->request(ApiMethodTypes::GET, ApiEndpoints::USERS);
    }

    /**
     * API call : get users
     * 
     * @param int $page
     * @param int $perPage
     * @return IApiResponse
     */
    public function getUsers(int $page = 1, int $perPage = 6): IApiResponse {
        $query = [
            'page' => $page,
            'per_page' => $perPage
        ];

        return $this->client->request(ApiMethodTypes::GET, ApiEndpoints::USERS, $query);
    }

    /**
     * API call : Add user with parameters
     * 
     * @param array $parameters
     * @return IApiResponse
     */
    public function addUser(array $parameters): IApiResponse {
        return $this->client->request(ApiMethodTypes::POST, ApiEndpoints::USERS, [], json_encode($parameters));
    }

    /**
     * API call : Delete user by id
     * @param int $id
     * @return IApiResponse
     */
    public function deleteUser(int $id): IApiResponse {
        $endpoint = sprintf('%s/%s', ApiEndpoints::USERS, $id);

        return $this->client->request(ApiMethodTypes::DELETE, $endpoint);
    }

    /**
     * Define parameters
     * 
     * @return void
     */
    private function defineParams(): void {
        $this->params['api_name'] = ApiInfos::API_NAME;
        $this->params['api_version'] = ApiInfos::API_VERSION;
        $this->params['protocol'] = ApiInfos::PROTOCOL;
        $this->params['host'] = ApiInfos::HOST;
        $this->params['path'] = ApiInfos::PATH;
    }

}
