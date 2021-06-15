<?php

namespace Totov\Cap\Tests;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Totov\Cap\Cap;

class DerivativeHierarchyTest extends TestCase
{
    private string $version;
    private string $derivativeType;
    private int $brandId;
    private int $modelId;
    private int $rangeId;
    private int $trimId;

    protected function setUp(): void
    {
        parent::setUp();
        $this->version = Cap::VERSION;
        $this->derivativeType = 'cars';
        $this->brandId = 123;
        $this->modelId = 456;
        $this->rangeId = 789;
        $this->trimId = 654;

        Http::fake([
            'https://identity.cap-hpi.com/connect/token' =>
                Http::response(["access_token" => "123456789", "expires_in" => "3600"], 200),

            // brands

            "https://api.cap-hpi.co.uk/v{$this->version}/{$this->derivativeType}/brands" =>
                Http::response(File::get('tests/stubs/brands-response.json'), 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/{$this->derivativeType}/brands/{$this->brandId}" =>
                Http::response(File::get('tests/stubs/brand-response.json'), 200),

            // models

            "https://api.cap-hpi.co.uk/v{$this->version}/{$this->derivativeType}/brands/{$this->brandId}/models" =>
                Http::response(File::get('tests/stubs/models-response.json'), 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/{$this->derivativeType}/ranges/{$this->rangeId}/models" =>
                Http::response(File::get('tests/stubs/models-response.json'), 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/{$this->derivativeType}/models/{$this->modelId}" =>
                Http::response(File::get('tests/stubs/model-response.json'), 200),

            // ranges

            "https://api.cap-hpi.co.uk/v{$this->version}/{$this->derivativeType}/brands/{$this->brandId}/ranges" =>
                Http::response(File::get('tests/stubs/ranges-response.json'), 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/{$this->derivativeType}/ranges/{$this->rangeId}" =>
                Http::response(File::get('tests/stubs/range-response.json'), 200),

            // derivatives

            "https://api.cap-hpi.co.uk/v{$this->version}/{$this->derivativeType}/models/{$this->modelId}/derivatives" =>
                Http::response(File::get('tests/stubs/derivatives-response.json'), 200),

            "https://api.cap-hpi.co.uk/v{$this->version}/{$this->derivativeType}/trims/{$this->trimId}/derivatives" =>
                Http::response(File::get('tests/stubs/derivatives-response.json'), 200),

            // trims

            "https://api.cap-hpi.co.uk/v{$this->version}/{$this->derivativeType}/models/{$this->modelId}/trims" =>
                Http::response(File::get('tests/stubs/trims-response.json'), 200),
        ]);
    }

    /** @test */
    public function brands_by_derivative_type(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->derivativeHierarchy->brands->byDerivativeType('cars');

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function brand_by_derivative_type_and_brand_id(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->derivativeHierarchy->brands->byDerivativeTypeAndBrandId($this->derivativeType, $this->brandId);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function models_by_derivative_type_and_brand_id(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->derivativeHierarchy->models->byDerivativeTypeAndBrandId($this->derivativeType, $this->brandId);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function model_by_derivative_type_and_model_id(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->derivativeHierarchy->models->byDerivativeTypeAndModelId($this->derivativeType, $this->modelId);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function models_by_derivative_type_and_range_id(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->derivativeHierarchy->models->byDerivativeTypeAndRangeId($this->derivativeType, $this->rangeId);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function ranges_by_derivative_type_and_brand_id(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->derivativeHierarchy->ranges->byDerivativeTypeAndBrandId($this->derivativeType, $this->brandId);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function range_by_derivative_type_and_range_id(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->derivativeHierarchy->ranges->byDerivativeTypeAndRangeId($this->derivativeType, $this->rangeId);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function derivatives_by_derivative_type_and_model_id(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->derivativeHierarchy->derivatives->byDerivativeTypeAndModelId($this->derivativeType, $this->modelId);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function derivatives_by_derivative_type_and_trim_id(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->derivativeHierarchy->derivatives->byDerivativeTypeAndTrimId($this->derivativeType, $this->trimId);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    /** @test */
    public function trims_by_derivative_type_and_model_id(): void
    {
        $cap = new Cap(null, null);
        $response = $cap->derivativeHierarchy->trims->byDerivativeTypeAndModelId($this->derivativeType, $this->modelId);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }
}
