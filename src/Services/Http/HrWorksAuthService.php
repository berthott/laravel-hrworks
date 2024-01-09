<?php

namespace berthott\HrWorks\Services\Http;

use Facades\berthott\HrWorks\Services\Http\HrWorksHttpService;
use berthott\HrWorks\Models\HrWorksAuthToken;
use Illuminate\Support\Carbon;

/*
 * Service to handle HrWorks auth tokens
 */
class HrWorksAuthService
{
    /*
    * Get the current auth token and retrieve a new one if expired.
    */
    public function token(): string
    {
        $token = HrWorksAuthToken::first();
        if (!$token || now()->lte($token->expires_at)) {
            HrWorksAuthToken::truncate();
            $newToken = json_decode(HrWorksHttpService::utility()->authenticate([
                'body' => config('hrworks.auth')
            ])->getBody()->getContents())->token;
            $decodedToken = json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $newToken)[1]))));
            $token = HrWorksAuthToken::create([
                'token' => $newToken,
                'expires_at'=> new Carbon($decodedToken->exp),
            ]);
        }
        return $token->token;
    }
}
