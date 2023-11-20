<?php

namespace App\Contracts;

use App\DataTransferObjects\Geolocation;

interface Geolocator
{
    public function locate(string $ip): Geolocation;
}
