<?php

namespace Tests\Feature;

use App\DataTransferObjects\Geolocation;
use App\Services\Providers\Geo1Provider;
use App\Services\Providers\Geo2Provider;
use App\Services\Providers\Geo3Provider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class GetGeolocationTest extends TestCase
{
    use RefreshDatabase;

    private string $ip;
    private string $encodedIp;
    private string $apiKey;
    private string $countryISO;

    protected function setUp(): void
    {
        parent::setUp();

        $this->encodedIp = base64_encode($this->ip = $this->faker->ipv4());
        $this->apiKey = config('app.api_key');
        $this->countryISO = 'RS';
    }

    /**
     * A basic test example.
     */
    public function test_get_geolocation_from_geo1(): void
    {
        $this->instance(
            Geo1Provider::class,
            Mockery::mock(Geo1Provider::class, fn (MockInterface $mock) =>
                $mock->shouldReceive('locate')
                    ->once()
                    ->andReturn(new Geolocation($this->ip, $this->countryISO))
            )
        );

        $response = $this->get('/ip?find=' . $this->encodedIp . '&api_key=' . $this->apiKey);

        $response->assertOk();
        $response->assertJsonFragment(['ip' => $this->ip, 'iso2' => $this->countryISO]);
    }

    public function test_get_geolocation_from_geo2(): void
    {
        $this->instance(
            Geo2Provider::class,
            Mockery::mock(Geo2Provider::class, fn (MockInterface $mock) =>
            $mock->shouldReceive('locate')
                ->once()
                ->andReturn(new Geolocation($this->ip, $this->countryISO))
            )
        );

        $response = $this->get('/ip?find=' . $this->encodedIp . '&api_key=' . $this->apiKey);

        $response->assertOk();
        $response->assertJsonFragment(['ip' => $this->ip, 'iso2' => $this->countryISO]);
    }

    public function test_get_geolocation_from_geo3(): void
    {
        $this->instance(
            Geo3Provider::class,
            Mockery::mock(Geo3Provider::class, fn (MockInterface $mock) =>
                $mock->shouldReceive('locate')
                    ->once()
                    ->andReturn(new Geolocation($this->ip, $this->countryISO))
            )
        );

        $response = $this->get('/ip?find=' . $this->encodedIp . '&api_key=' . $this->apiKey);

        $response->assertOk();
        $response->assertJsonFragment(['ip' => $this->ip, 'iso2' => $this->countryISO]);
    }
}
