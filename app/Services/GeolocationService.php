<?php

namespace App\Services;

use App\DataTransferObjects\Geolocation;
use Illuminate\Support\Facades\Cache;
use App\Models\GeolocationProvider;
use Illuminate\Support\Facades\Log;

class GeolocationService
{
    public function __construct(private array $geoLocators)
    {
        $geoProviders = GeolocationProvider::getOrderedBySuccessRate();

        foreach ($geoProviders as $geoService) {
            $this->$geoLocators[] = app($geoService->name);
        }
    }

    public function getCountryByIp(string $ip): Geolocation
    {
        $country = Cache::get($ip);

        if ($country) {
            return $country;
        }

        foreach ($this->geoLocators as $geoLocator) {

            try {
                $country = $geoLocator->locate($ip);

                Cache::put($ip, $country, 60); // Cache for 1 hour

                GeolocationProvider::incrementSuccessRateForProvider(get_class($geoLocator));

                break;
            } catch (\Exception $e) {
                // Log the error and continue with the next provider
                Log::error($e->getMessage());
            }
        }

        if (!$country) {
            throw new \Exception('failed to retrieve country.');
        }

        return $country;
    }
}
