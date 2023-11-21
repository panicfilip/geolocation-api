<?php

namespace App\Services\Providers;

use App\Contracts\Geolocator;
use App\DataTransferObjects\Geolocation;
use Illuminate\Support\Facades\Http;

class Geo2Provider implements Geolocator
{
    private const BASE_URL = 'http://geo2api.com/';

    public function locate(string $ip): Geolocation
    {
        $token = config('app.geo2_api_key');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->post(self::BASE_URL .'ips', [
            'ip' => $ip,
        ]);

        if ($response->successful() && $response['status'] == 'success') {
            $data = $response->json();
            return new Geolocation($ip, $data['country']);
        }

        throw new \Exception('Failed to retrieve country from Geo2.');
    }
}
