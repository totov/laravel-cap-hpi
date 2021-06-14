<?php

namespace Totov\Cap\Tests;

use Illuminate\Support\Facades\Http;
use Totov\Cap\Cap;
use Totov\Cap\Exceptions\AuthorisationFailedException;

class AuthoriseRequestTest extends TestCase
{
    /** @test */
    public function valid_authorise_request_test(): void
    {
        $token = "123456789";

        Http::fake([
            'https://identity.cap-hpi.com/connect/token' =>
                Http::response(["access_token" => $token, "expires_in" => "3600"], 200),
        ]);

        $cap = new Cap(null, null);
        $this->assertEquals($token, $cap->getValidToken());
    }

    /** @test */
    public function invalid_authorise_request_test(): void
    {
        Http::fake([
            'https://identity.cap-hpi.com/connect/token' =>
                Http::response(["error" => "invalid_client"], 400),
        ]);

        $this->expectException(AuthorisationFailedException::class);

        new Cap(null, null);
    }
}
