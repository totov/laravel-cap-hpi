<?php

namespace Totov\Cap\Tests;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Totov\Cap\Cap;

class MotHistoryTest extends TestCase
{
    private string $version;
    private string $vin;
    private string $vrm;

    protected function setUp(): void
    {
        parent::setUp();
        $this->version = Cap::VERSION;
        $this->vin = 'WBAWA72020PZ12345';
        $this->vrm = 'AB12CDE';

        Http::fake([
            'https://identity.cap-hpi.com/connect/token' =>
                Http::response(["access_token" => "123456789", "expires_in" => "3600"], 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/vins/{$this->vin}/mots" =>
                Http::response(File::get('tests/stubs/mot-history-response.json'), 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/vrms/{$this->vrm}/mots" =>
                Http::response(File::get('tests/stubs/mot-history-response.json'), 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/vins/{$this->vin}/vrms/{$this->vrm}/mots" =>
                Http::response(File::get('tests/stubs/mot-history-response.json'), 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/vins/{$this->vin}/mots/latest" =>
                Http::response(File::get('tests/stubs/latest-mot-details-response.json'), 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/vrms/{$this->vrm}/mots/latest" =>
                Http::response(File::get('tests/stubs/latest-mot-details-response.json'), 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/vins/{$this->vin}/vrms/{$this->vrm}/mots/latest" =>
                Http::response(File::get('tests/stubs/latest-mot-details-response.json'), 200),
        ]);
    }

    /** @test */
    public function by_vin_lookup_test(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->motHistory->byVin($this->vin);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function by_vrm_lookup_test(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->motHistory->byVrm($this->vrm);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function by_vin_and_vrm_lookup_test(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->motHistory->byVinAndVrm($this->vin, $this->vrm);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function latest_by_vin_lookup_test(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->motHistory->byVin($this->vin, true);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function latest_by_vrm_lookup_test(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->motHistory->byVrm($this->vrm, true);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function latest_by_vin_and_vrm_lookup_test(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->motHistory->byVinAndVrm($this->vin, $this->vrm, true);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }
}
