<?php

namespace App\Service\Shipper;

use App\Model\Shipper;
use App\Repositories\ShipperRepository;


class ShipperService
{
    /**
     * @var ShipperRepository
     */
    protected $shipperRepository;

    /**
     * @param ShipperRepository $shipperRepository
     */
    public function __construct(ShipperRepository $shipperRepository)
    {
        $this->shipperRepository = $shipperRepository;
    }

    public function index()
    {
        return $this->shipperRepository->index();
    }

    public function create(array $data): Shipper
    {
        return $this->shipperRepository->create($data);
    }

    public function update(int $id, array $data): Shipper
    {
        return $this->shipperRepository->update($id, $data);
    }
}
