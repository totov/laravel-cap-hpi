<?php

namespace Totov\Cap\Tests;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Totov\Cap\Cap;

class DerivativeDetailsTest extends TestCase
{
    private string $version;
    private string $derivativeType;
    private string $capId;
    private string $vin;
    private string $vrm;

    protected function setUp(): void
    {
        parent::setUp();
        $this->version = Cap::VERSION;
        $this->derivativeType = 'cars';
        $this->capId = '123456';
        $this->vin = 'WBAWA72020PZ12345';
        $this->vrm = 'AB12CDE';

        Http::fake([
            'https://identity.cap-hpi.com/connect/token' =>
                Http::response(["access_token" => "123456789", "expires_in" => "3600"], 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/derivative-types/derivative-details" =>
                Http::response(["cars", "lcvs", "bikes", "hgvs",], 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/{$this->derivativeType}/{$this->capId}" =>
                Http::response(File::get('tests/stubs/equipment-response.json'), 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/vins/{$this->vin}/derivative" =>
                Http::response(File::get('tests/stubs/equipment-response.json'), 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/vrms/{$this->vrm}/derivative" =>
                Http::response(File::get('tests/stubs/equipment-response.json'), 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/vins/{$this->vin}/vrms/{$this->vrm}/derivative" =>
                Http::response(File::get('tests/stubs/equipment-response.json'), 200),
        ]);
    }

    /** @test */
    public function supported_derivative_types_lookup_test(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->derivativeDetails->supportedDerivativeTypes();

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function by_derivative_type_and_cap_id_lookup_test(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->derivativeDetails->byDerivativeTypeAndCapId($this->derivativeType, $this->capId);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function by_vin_lookup_test(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->derivativeDetails->byVin($this->vin);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function by_vrm_lookup_test(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->derivativeDetails->byVrm($this->vrm);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function by_vin_and_vrm_lookup_test(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->derivativeDetails->byVinAndVrm($this->vin, $this->vrm);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }
}
