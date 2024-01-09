<?php

namespace berthott\HrWorks\Services\Http;

use Facades\berthott\HrWorks\Helpers\HrWorksLog;
use GuzzleHttp\Client;
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
        $arguments = Arr::collapse($arguments);
        [$url , $method] = $this->getUrlAndMethod($name, $arguments);
        HrWorksLog::log("Requesting $method $url...");
        return $this->http()->request($method, $url, $arguments);
    }
    
    /**
     * Create a configured http client.
     */
    private function http(): Client
    {        
        return new Client();
    }

    /**
     * Get the URL and Method to use.
     * 
     * @return string[]
     */
    private function getUrlAndMethod(string $endpoint, array& $values): array
    {
        $api = config("hrworks.api.{$this->api}");
        $url = $api[$endpoint]['api'];

        foreach ($values as $name => $value) {
            if (is_string($value)) {
                $url = str_replace('{'.$name.'}', $value, $url);
            }
        }

        if (array_key_exists('body', $values)) {
            if (!(is_string($values['body']) && json_validate($values['body']))) {
                $values['body'] = json_encode($values['body']);
            }
        }

        return [$url , $api[$endpoint]['method']];
    }
}
