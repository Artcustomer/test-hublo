<?php

namespace App\ApiConnector\Reqres\Client;

use App\Library\Artcustomer\ApiUnit\Client\CurlApiClient;
use App\ApiConnector\Reqres\Utils\ApiInfos;
use App\ApiConnector\Reqres\Utils\ApiTools;
use App\ApiConnector\Reqres\Http\ApiRequest;
use App\ApiConnector\Reqres\Factory\Decorator\ResponseDecorator;

/**
 * @author David
 */
class ApiClient extends CurlApiClient {

    /**
     * Constructor
     * 
     * This client is configured to return response as objects.
     * It helps to manipulate data before encoding items to json format.
     * 
     * @param array $params
     */
    public function __construct(array $params) {
        parent::__construct($params);

        $this->responseDecoratorClassName = ResponseDecorator::class;
        $this->responseDecoratorArguments = [ApiTools::CONTENT_TYPE_OBJECT];

        $this->enableEvents = false;
        $this->enableMocks = false;
        $this->debugMode = false;
    }

    /**
     * Initialize client
     */
    public function initialize() {
        $this->init();
        $this->checkParams();
    }

    /**
     * Pre build request
     * 
     * @param string $method
     * @param string $endpoint
     * @param array $query
     * @param type $body
     * @param array $headers
     * @return void
     */
    protected function preBuildRequest(string $method, string $endpoint, array $query = [], $body = null, array $headers = []): void {
        $this->requestClassName = ApiRequest::class;
    }

    /**
     * Check parameters
     * 
     * @throws \Exception
     */
    private function checkParams() {
        $requiredParams = ['protocol', 'host', 'path'];

        foreach ($requiredParams as $param) {
            if (!isset($this->apiParams[$param])) {
                $this->isOperational = false;
            }
        }

        if (!$this->isOperational) {
            throw new \Exception(sprintf('%s : Missing params', ApiInfos::API_NAME), 500);
        }
    }

}
