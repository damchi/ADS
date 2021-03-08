<?php
declare(strict_types=1);

namespace App\Application\Actions\Vehicle;

use Psr\Http\Message\ResponseInterface as Response;

class ListVehiclesAction extends VehicleAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $filters = $this->request->getBody()->getContents();

        $vehicles = $this->vehicleRepository->findAll(json_decode($filters, true));

        $this->logger->info("Vehicles list was viewed.");

        return $this->respondWithJSON(['vehicles' => $vehicles]);
    }
}
