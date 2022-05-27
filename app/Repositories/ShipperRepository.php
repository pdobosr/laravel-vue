<?php

namespace App\Repositories;

use App\Model\Shipper;

class ShipperRepository
{
    public $model;

    public function __construct()
    {
        $this->model = new Shipper();
    }

    public function index()
    {
        return $this->model::query()
            ->with('contacts')
            ->with('primaryContact')
            ->get();
    }

    public function create($data): Shipper
    {
        $shipper = $this->model->store($data);

        $shipper->contacts()->sync($data['contact_ids']);

        return $shipper;
    }

    public function update($id, $data): Shipper
    {
        $shipper = Shipper::find($id);

        $shipper = $this->model->edit($shipper, $data);

        $shipper->contacts()->sync($data['contact_ids']);

        return $shipper;
    }
}
