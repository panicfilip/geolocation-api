<?php

namespace App\DataTransferObjects;

class Geolocation
{
    public function __construct(public string $ip, public string $iso2) {}
}
