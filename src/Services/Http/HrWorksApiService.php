<?php

namespace berthott\HrWorks\Services\Http;

use Exception;
use Facades\berthott\HrWorks\Helpers\HrWorksLog;
use Facades\berthott\HrWorks\Services\Http\HrWorksAuthService;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Header;
use Illuminate\Support\Arr;

/*
 * Service actually calling the HrWorks API endpoints.
 * 
 * @see \berthott\HrWorks\Services\Http\HrWorksHttpService
 * @see file://config/config.php
 */
class HrWorksApiService
{
    /*
    * The API to call.
    */
    protected string $api;

    /*
    * Set the API to call.
    */
    public function api(string $api): self
    {
        $this->api = $api;
        return $this;
    }

    /**
     * Call to the API.
     * Query parameter must be wrapped in 'query' array.
     * Body parameter must be wrapped in 'body' array.
     * URL parameter can be on top level.
     */
    public function __call(string $name, array $arguments): mixed
    {
        $arguments = $this->setBodyAndHeaders($name, Arr::collapse($arguments));
        [$url , $method] = $this->getUrlAndMethod($name, $arguments);
        HrWorksLog::log("Requesting $method $url...");
        return $this->getUnpaginatedResult($method, $url, $arguments);
    }
    
    /**
     * Run the request and repeat it for as long as there are pages left.
     */
    private function getUnpaginatedResult($method, $url, $arguments): mixed
    {   
        $result = [];
        $page = 1;

        $stream = $this->http()->request($method, $url, $arguments);
        $response = json_decode($stream->getBody()->getContents());
        if (!$response) {
            return $response;
        }
        $result += (array) $response;
        $links = Header::parse($stream->getHeader('Link'));

        while($links && count($links) > 1) {
            // add page to query
            $query = $arguments['query'] ?? [];
            $query = array_merge($query, ['page' => ++$page]);
            $arguments['query'] = $query;

            // resend the request
            $stream = $this->http()->request($method, $url, $arguments);
            $result += (array) json_decode($stream->getBody()->getContents());
            $links = Header::parse($stream->getHeader('Link'));
        }
        return (object) $result;
    }

    
    /**
     * Create a configured http client.
     */
    private function http(): Client
    {        
        return new Client();
    }

    /**
     * Get the URL and method to use.
     * 
     * @return string[]
     */
    private function getUrlAndMethod(string $endpoint, array $values): array
    {
        try {
            $api = config("hrworks.api.{$this->api}");
            $url = $api[$endpoint]['api'];
        } catch(Exception) {
            throw new Exception('The desired endpoint '.$this->api.'.'.$endpoint.' is not defined.');
        }


        foreach ($values as $name => $value) {
            if (is_string($value)) {
                $url = str_replace('{'.$name.'}', $value, $url);
            }
        }

        if (array_key_exists('body', $values)) {
            if (!(is_string($values['body']) && $this->is_valid_json($values['body']))) {
                $values['body'] = json_encode($values['body']);
            }
        }

        return [$url , $api[$endpoint]['method']];
    }

    /**
     * Set body and headers.
     * 
     * Ensures that the body is json encoded and that the correct auth header is set.
     */
    private function setBodyAndHeaders(string $endpoint, array $arguments): array
    {
        // ensure json encoding
        if (array_key_exists('body', $arguments)) {
            if (!(is_string($arguments['body']) && $this->is_valid_json($arguments['body']))) {
                $arguments['body'] = json_encode($arguments['body']);
            }
        }

        // add auth header
        if ($endpoint != 'authenticate') {
            $header = array_key_exists('headers', $arguments) ? $arguments['headers'] : [];
            $token = HrWorksAuthService::token();
            $header['Authorization'] = "Bearer $token";
            $arguments['headers'] = $header;
        }

        // add no cache header
        if (!config('hrworks.cache_enabled')) {
            $header = array_key_exists('headers', $arguments) ? $arguments['headers'] : [];
            $header['Cache-Control'] = 'no-cache';
            $arguments['headers'] = $header;
        }

        return $arguments;
    }

    /**
     * Determine if the given string is valid json
     */
    private function is_valid_json(string $json): bool
    {
        return (json_decode($json, true) == NULL) ? false : true ;
    }
}
