<?php

namespace Totov\Cap\Tests;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Totov\Cap\Cap;

class TechnicalSpecificationTest extends TestCase
{
    private string $version;
    private string $vin;
    private string $vrm;
    private string $derivativeType;
    private string $capId;

    protected function setUp(): void
    {
        parent::setUp();
        $this->version = Cap::VERSION;
        $this->derivativeType = 'cars';
        $this->capId = '123456';
        $this->vin = 'WBAWA72020PZ12345';
        $this->vrm = 'AB12CDE';
        $this->categoryId = 1;

        Http::fake([
            'https://identity.cap-hpi.com/connect/token' =>
                Http::response(["access_token" => "123456789", "expires_in" => "3600"], 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/derivative-types/technical-specification" =>
                Http::response(["cars", "lcvs", "bikes", "hgvs",], 200),

            // categories

            "https://api.cap-hpi.co.uk/v{$this->version}/{$this->derivativeType}/technical-specifications/categories" =>
                Http::response(File::get('tests/stubs/technical-specifications-categories-response.json'), 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/{$this->derivativeType}/technical-specifications/categories/{$this->categoryId}" =>
                Http::response(File::get('tests/stubs/technical-specifications-category-response.json'), 200),

            // vehicle specs

            "https://api.cap-hpi.co.uk/v{$this->version}/{$this->derivativeType}/{$this->capId}/technical-specifications/" =>
                Http::response(File::get('tests/stubs/technical-specifications-response.json'), 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/vins/{$this->vin}/technical-specifications/" =>
                Http::response(File::get('tests/stubs/technical-specifications-response.json'), 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/vrms/{$this->vrm}/technical-specifications/" =>
                Http::response(File::get('tests/stubs/technical-specifications-response.json'), 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/vins/{$this->vin}/vrms/{$this->vrm}/technical-specifications/" =>
                Http::response(File::get('tests/stubs/technical-specifications-response.json'), 200),

        ]);
    }

    /** @test */
    public function supported_derivative_types_lookup_test(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->technicalSpecification->supportedDerivativeTypes();

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }
}
