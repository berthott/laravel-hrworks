<?php

namespace berthott\HrWorks\Services\Http;

use berthott\HrWorks\Services\Http\HrWorksApiService;

/*
 * Service to distinguish between different HrWorks API endpoints.
 * 
 * @see \berthott\SX\Services\Http\SxApiService
 * @see file://config/config.php
 */
class HrWorksHttpService
{
    public function __call(string $name, array $arguments): mixed
    {
        return (new HrWorksApiService)->api($name);
    }
}
