<?php

namespace App\Services\Providers;

use App\Contracts\Geolocator;
use App\DataTransferObjects\Geolocation;
use Illuminate\Support\Facades\Http;

class Geo1Provider implements Geolocator
{
    private const BASE_URL = 'https://geo1api.com/';

    public function locate(string $ip): Geolocation
    {
        $encodedIP = base64_encode($ip);
        $apiKey = config('app.geo1_api_key');

        $response = Http::get($this::BASE_URL . "ip?find={$encodedIP}&api_key={$apiKey}");

        if ($response->successful()) {
            $data = $response->json();
            return new Geolocation($data['ip'], $data['iso2']);
        }

        throw new \Exception('Failed to retrieve country from Geo1.');
    }
}
