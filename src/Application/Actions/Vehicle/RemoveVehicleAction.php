<?php
declare(strict_types=1);


namespace App\Application\Actions\Vehicle;

use Psr\Http\Message\ResponseInterface as Response;

class RemoveVehicleAction extends VehicleAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $vehicleId = $this->request->getAttribute('id');

        $vehicle = $this->vehicleRepository->setDeleteVehicle(intval($vehicleId));

        $this->logger->info("Vehicle  deleted:" . $vehicleId);

        return $this->respondWithJSON($vehicle);
    }

}