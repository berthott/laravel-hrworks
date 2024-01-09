<?php

namespace berthott\HrWorks\Tests\Unit\Api;

use berthott\HrWorks\HrWorksServiceProvider;
use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class ApiTestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            HrWorksServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        Config::set('hrworks.auth', [
            'accessKey' => 'fxLXEk7FsXybaMsKrk8e',
            'secretAccessKey' => 'Y4RE3N7pWhYqZ2CZmA4HbLZPWSHPF7SxNL7eQx4I',
        ]);
    }
}
