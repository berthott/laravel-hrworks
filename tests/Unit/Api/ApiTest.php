<?php

namespace berthott\HrWorks\Tests\Unit\Api;

use Facades\berthott\HrWorks\Services\Http\HrWorksHttpService;

class ApiTest extends ApiTestCase
{
    public function test_auth(): void
    {
        $response = HrWorksHttpService::utility()->authenticate([
            'body' => config('hrworks.auth')
        ]);
        $this->assertEquals($response->getStatusCode(), 200);
    }
}
