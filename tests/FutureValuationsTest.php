<?php

namespace Totov\Cap\Tests;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Totov\Cap\Cap;
use Totov\Cap\Subsets\FutureValuations\FutureValuationOptions;

class FutureValuationsTest extends TestCase
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

            "https://api.cap-hpi.co.uk/v{$this->version}/derivative-types/future-valuations" =>
                Http::response(["cars", "lcvs", "bikes", "hgvs",], 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/valuation-types/future-valuations" =>
                Http::response(File::get('tests/stubs/future-valuation-types-response.json'), 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/{$this->derivativeType}/{$this->capId}/future-valuations" =>
                Http::response(File::get('tests/stubs/future-valuation-response.json'), 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/vins/{$this->vin}/future-valuations" =>
                Http::response(File::get('tests/stubs/future-valuation-response.json'), 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/vrms/{$this->vrm}/future-valuations" =>
                Http::response(File::get('tests/stubs/future-valuation-response.json'), 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/vins/{$this->vin}/vrms/{$this->vrm}/future-valuations" =>
                Http::response(File::get('tests/stubs/future-valuation-response.json'), 200),
        ]);
    }

    /** @test */
    public function supported_derivative_types_lookup_test(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->futureValuations->supportedDerivativeTypes();

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function supported_valuation_types_lookup_test(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->futureValuations->supportedValuationTypes();

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function by_derivative_type_and_cap_id_lookup_test(): void
    {
        $cap = new Cap(null, null);

        $options = new FutureValuationOptions(['TradeClean'], [['mileage' => 25000, 'valuationDate' => '2021-09-19']]);
        $response = $cap->futureValuations->byDerivativeTypeAndCapId($this->derivativeType, $this->capId, $options);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function by_vin_lookup_test(): void
    {
        $cap = new Cap(null, null);

        $options = new FutureValuationOptions(['TradeClean'], [['mileage' => 25000, 'valuationDate' => '2021-09-19']]);
        $response = $cap->futureValuations->byVin($this->vin, $options);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function by_vrm_lookup_test(): void
    {
        $cap = new Cap(null, null);

        $options = new FutureValuationOptions(['TradeClean'], [['mileage' => 25000, 'valuationDate' => '2021-09-19']]);
        $response = $cap->futureValuations->byVrm($this->vrm, $options);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function by_vin_and_vrm_lookup_test(): void
    {
        $cap = new Cap(null, null);

        $options = new FutureValuationOptions(['TradeClean'], [['mileage' => 25000, 'valuationDate' => '2021-09-19']]);
        $response = $cap->futureValuations->byVinAndVrm($this->vin, $this->vrm, $options);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }
}
