<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetGeolocationXTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_server_error_from_geo1_when_find_is_not_provided(): void
    {
        $apiKey = 'secret';

        $response = $this->get('/ip?&api_key=' . $apiKey);

        $response->assertServerError();
        $response->assertJson(['reason' => trans('errors.geolocation_failed')]);
    }

    public function test_get_unauthorized_error_from_geo1_with_invalid_api_key(): void
    {
        $apiKey = 'falseSecret';

        $response = $this->get('/ip?&api_key=' . $apiKey);

        $response->assertUnauthorized();
        $response->assertJson(['reason' => trans('errors.api_key')]);
    }

    public function test_get_server_error_from_geo1_with_invalid_find(): void
    {
        $encodedIP = base64_encode($this->faker->ipv4());
        $apiKey = 'secret';
        
        $response = $this->get('/ip?find=' . $encodedIP . '&api_key=' . $apiKey);

        $response->assertServerError();
        $response->assertJson(['reason' => trans('errors.geolocation_failed')]);
    }
}
