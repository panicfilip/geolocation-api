<?php

namespace Tests\Feature;

use App\DataTransferObjects\Geolocation;
use App\Services\Providers\Geo1Provider;
use App\Services\Providers\Geo2Provider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class GetGeolocationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_get_geolocation_from_geo1(): void
    {
        $encodedIP = base64_encode($ip = $this->faker->ipv4());
        $apiKey = config('app.api_key');
        $countryISO = 'RS';

        $this->instance(
            Geo1Provider::class,
            Mockery::mock(Geo1Provider::class, fn (MockInterface $mock) =>
                $mock->shouldReceive('locate')
                    ->once()
                    ->andReturn(new Geolocation($ip, $countryISO))
            )
        );

        $response = $this->get('/ip?find=' . $encodedIP . '&api_key=' . $apiKey);

        $response->assertOk();
        $response->assertJsonFragment(['ip' => $ip, 'iso2' => $countryISO]);
    }
}
