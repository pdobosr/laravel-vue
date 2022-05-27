<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Shippers\StoreShipperRequest;
use App\Http\Requests\Shippers\UpdateShipperRequest;
use App\Service\Shipper\ShipperService;

class ShipperController extends BaseApiController
{
    public function index(ShipperService $shipperService)
    {
        return self::_index($shipperService);
    }

    public function store(StoreShipperRequest $request, ShipperService $shipperService): \Illuminate\Http\JsonResponse
    {
        return self::_store($request, $shipperService);
    }

    public function update($id, UpdateShipperRequest $request, ShipperService $shipperService): \Illuminate\Http\JsonResponse
    {
        return self::_update($id, $request, $shipperService);
    }

}
