<?php

namespace berthott\HrWorks\Tests\Unit\Api;

use Facades\berthott\HrWorks\Services\Http\HrWorksHttpService;
use Facades\berthott\HrWorks\Services\Http\HrWorksAuthService;

class ApiTest extends ApiTestCase
{
    public function test_auth_request(): void
    {
        $response = HrWorksHttpService::utility()->authenticate([
            'body' => config('hrworks.auth')
        ]);
        $this->assertEquals($response->getStatusCode(), 200);
    }

    public function test_retrieving_auth_token(): void
    {
        $this->assertDatabaseCount('hr_works_auth_tokens', 0);
        $token = HrWorksAuthService::token();
        $this->assertDatabaseCount('hr_works_auth_tokens', 1);
    }

    public function test_authenticated_request(): void
    {
        $response = HrWorksHttpService::utility()->checkHealth();
        $this->assertEquals($response->getStatusCode(), 200);
    }
}
