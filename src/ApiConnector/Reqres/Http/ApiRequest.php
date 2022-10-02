<?php

namespace App\ApiConnector\Reqres\Http;

use App\Library\Artcustomer\ApiUnit\Http\CurlApiRequest;

/**
 * @author David
 */
class ApiRequest extends CurlApiRequest {

    private $protocol;
    private $host;
    private $path;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Build request
     */
    public function build(): void {
        parent::build();

        $this->headers[] = 'Content-type: application/json';
        $this->headers[] = 'Content-length: 0';
    }

    /**
     * Setup request
     *
     * @param type $apiParams
     * @return void
     */
    public function setup($apiParams): void {
        if (array_key_exists('protocol', $apiParams)) {
            $this->protocol = $apiParams['protocol'];
        }

        if (array_key_exists('host', $apiParams)) {
            $this->host = $apiParams['host'];
        }

        if (array_key_exists('path', $apiParams)) {
            $this->path = $apiParams['path'];
        }

        $this->uri = sprintf('%s%s/%s/%s', $this->protocol, $this->host, $this->path, $this->endpoint);
    }

    /**
     * Build options
     */
    protected function buildOptions(): void {
        $this->options[CURLOPT_SSL_VERIFYHOST] = 0;
        $this->options[CURLOPT_SSL_VERIFYPEER] = 0;
        $this->options[CURLOPT_HEADER] = 0;
        $this->options[CURLOPT_ENCODING] = '';
        $this->options[CURLOPT_RETURNTRANSFER] = 1;
        $this->options[CURLOPT_FOLLOWLOCATION] = 1;
        $this->options[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_1;
        $this->options[CURLOPT_HTTPHEADER] = ['Content-Type: application/json'];
    }

    /**
     * Generate headers
     * 
     * @return array
     */
    protected function generateHeaders(): array {
        $headers = [];

        return array_merge($headers, $this->headers);
    }

}
