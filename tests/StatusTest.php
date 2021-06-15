<?php

namespace Totov\Cap\Tests;

use Illuminate\Support\Facades\Http;
use Totov\Cap\Cap;

class StatusTest extends TestCase
{
    /** @test */
    public function health_status_request_test(): void
    {
        Http::fake([
            'https://api.cap-hpi.co.uk/health' =>
                Http::response(["status" => "UP"], 200),
        ]);

        $status = Cap::status();
        $this->assertEquals('UP', $status);
    }

    /** @test */
    public function healthz_status_request_test(): void
    {
        Http::fake([
            'https://api.cap-hpi.co.uk/healthz' =>
                Http::response(["status" => "UP"], 200),
        ]);

        $status = Cap::status(true);
        $this->assertEquals('UP', $status);
    }
}
