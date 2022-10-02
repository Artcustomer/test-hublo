<?php

namespace App\Service;

use App\ApiConnector\Reqres\ReqresApiConnector;

/**
 * @author David
 */
class ReqresService {

    private ReqresApiConnector $reqresApiConnector;

    /**
     * Constructor
     */
    public function __construct() {
        $this->setupApiConnector();
    }

    /**
     * Setup ReqresApiConnector instance
     * 
     * @return void
     */
    private function setupApiConnector(): void {
        $this->reqresApiConnector = new ReqresApiConnector();
        $this->reqresApiConnector->initialize();
    }

    /**
     * Get ReqresApiConnector instance
     * 
     * @return ReqresApiConnector
     */
    public function getConnector(): ReqresApiConnector {
        return $this->reqresApiConnector;
    }

}
