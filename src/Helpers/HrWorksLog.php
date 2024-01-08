<?php

namespace berthott\HrWorks\Helpers;

use Illuminate\Support\Facades\Log;

/**
 * Logging helper class.
 */
class HrWorksLog
{
    /**
     * Log a message to the `hrworks` log.
     */
    public function log(string $message): void
    {
        Log::channel('hrworks')->info($message);
    }
}
