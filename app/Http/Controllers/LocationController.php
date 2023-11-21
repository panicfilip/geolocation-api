<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetLocationRequest;
use App\Http\Resources\LocationResource;
use App\Services\GeolocationService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Geolocation API',
)]
#[OA\Tag(
    name: 'Location',
)]
class LocationController extends Controller
{
    #[OA\Get(
        path: '/ip',
        description: 'Get geolocation by IP',
        tags: ['Location'],
        parameters: [
            new OA\Parameter(
                name: 'find',
                in: 'query',
            ),
            new OA\Parameter(
                name: 'api_key',
                in: 'query',
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'OK'),
            new OA\Response(response: 500, description: 'Server error'),
        ]
    )]
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
