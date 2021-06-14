<?php

namespace Totov\Cap\Tests;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Totov\Cap\Cap;

class VersionRequestTest extends TestCase
{
    /** @test */
    public function errors_request_test(): void
    {
        Http::fake([
            'https://identity.cap-hpi.com/connect/token' =>
                Http::response(["access_token" => "123456789", "expires_in" => "3600"], 200),

            'https://api.cap-hpi.co.uk/version' =>
                Http::response(File::get('tests/stubs/version-response.json'), 200),
        ]);

        $cap = new Cap(null, null);
        $response = $cap->version();

        $this->assertIsArray($response);
    }
}
