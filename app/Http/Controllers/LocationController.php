<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetLocationRequest;
use App\Http\Resources\LocationResource;
use App\Services\GeolocationService;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    public function index(GetLocationRequest $request, GeolocationService $geolocationService): LocationResource|JsonResponse
    {
        try {
            $request->validateFindParam();
            return new LocationResource($geolocationService->getCountryByIp($request->get('find')));
        } catch (\Exception $e) {
            return response()->json([
                'reason' => trans('errors.geolocation_failed'),
            ], 500);
        }
    }
}
