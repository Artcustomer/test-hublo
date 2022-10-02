<?php

namespace App\Library\Artcustomer\ApiUnit\Connector;

use App\Library\Artcustomer\ApiUnit\Client\AbstractApiClient;
use App\Library\Artcustomer\ApiUnit\Event\IApiEventHandler;
use App\Library\Artcustomer\ApiUnit\Http\IApiResponse;
use App\Library\Artcustomer\ApiUnit\Logger\IApiLogger;

abstract class AbstractApiGateway {

    /**
     * @var AbstractApiClient
     */
    protected $client;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * AbstractApiGateway constructor.
     * @param string|NULL $clientClassName
     * @param array $clientArguments
     * @throws \ReflectionException
     */
    public function __construct(string $clientClassName = NULL, array $clientArguments = []) {
        if (NULL !== $clientClassName) {
            $this->setupClient($clientClassName, $clientArguments);
        }
    }

    /**
     * Setup Client
     * @param string $clientClassName
     * @param array $clientArguments
     * @throws \ReflectionException
     */
    private function setupClient(string $clientClassName, array $clientArguments = []): void {
        $reflection = new \ReflectionClass($clientClassName);

        $this->client = $reflection->newInstanceArgs($clientArguments);
    }

    /**
     * Initialize statement
     */
    abstract public function initialize(): void;

    /**
     * Implement a call to test API
     * @return IApiResponse
     */
    abstract public function test(): IApiResponse;

    /**
     * Set IApiLogger instance
     * @param IApiLogger $apiLogger
     */
    public function setApiLogger(IApiLogger $apiLogger): void {
        if (NULL !== $this->client) {
            $this->client->setApiLogger($apiLogger);
        }
    }

    /**
     * Set IApiEventHandler instance
     * @param IApiEventHandler $eventHandler
     */
    public function setEventHandler(IApiEventHandler $eventHandler): void {
        if (NULL !== $this->client) {
            $this->client->setEventHandler($eventHandler);
        }
    }

}
