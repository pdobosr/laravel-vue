<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ModelCreationException;
use App\Exceptions\ModelUpdateException;
use App\Http\Controllers\Controller;

class BaseApiController extends Controller
{
    public function _index($service)
    {
        return $service->index();
    }

    public function _store($request, $service, $getModelData = null): \Illuminate\Http\JsonResponse
    {
        $data = $this->getData($request, $getModelData);

        $created = $service->create($data);

        if (!$created) {
            throw new ModelCreationException(__('Model creation is failed'));
        }

        return response()->json([
            'data' => $created,
        ]);
    }

    public function _update($id, $request, $service, $getModelData = null): \Illuminate\Http\JsonResponse
    {
        $data = $this->getData($request, $getModelData);

        $updated = $service->update($id, $data);

        if (!$updated) {
            throw new ModelUpdateException(__('Model update is failed'));
        }

        return response()->json([
            'data' => $updated,
        ]);
    }

    private function getData($request, $getModelData = null)
    {
        $data = $request->validated();
        if ($getModelData) {
            $data = $getModelData($data);
        }

        return $data;
    }
}
