<?php

namespace App\Services\Providers;

use App\Contracts\Geolocator;
use App\DataTransferObjects\Geolocation;
use Illuminate\Support\Facades\Http;

class Geo3Provider implements Geolocator
{
    private const BASE_URL = 'https://geo3api.com/';
    public function locate(string $ip): Geolocation
    {
        $serviceKey = config('app.geo3_service_key');

        $tokenResponse = Http::withHeaders([
            'Authorization' => 'KEY ' . $serviceKey,
        ])->get(self::BASE_URL . 'tokens');

        if ($tokenResponse->failed()) {
            throw new \Exception('Failed to retrieve token from Geo3.');
        }

        $token = $tokenResponse->body();

        $countryResponse = Http::withHeaders([
            'X-TOKEN' => $token,
            'Accept' => 'application/json',
        ])->post(self::BASE_URL . 'countries', [
            'ip' => $ip,
        ]);

        if ($countryResponse->successful()) {
            $data = $countryResponse->json();
            return new Geolocation($ip, $data['iso2']);
        }

        throw new \Exception('Failed to retrieve country from Geo3.');
    }
}
