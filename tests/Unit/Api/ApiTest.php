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
        $this->assertNotEmpty($response->token);
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
        $this->assertNull($response);
    }

    public function test_pagination(): void
    {
        // precondition for this test is, that the hrworks demo hast more than 50 persons registered
        $response = HrWorksHttpService::person()->getAvailableWorkingHours([
            'query' => [
                'beginDate' => '2024-01-01',
                'endDate' => '2024-02-29',
                'interval' => 'months',
            ]
        ]);
        $this->assertGreaterThan(50, count((array)$response));
    }
}
