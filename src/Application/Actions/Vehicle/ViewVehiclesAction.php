<?php
declare(strict_types=1);

namespace App\Application\Actions\Vehicle;

use Psr\Http\Message\ResponseInterface as Response;

class ViewVehiclesAction extends VehicleAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $vehicleId = (int) $this->resolveArg('id');
        $vehicle = $this->vehicleRepository->findOne($vehicleId);

        $this->logger->info("Vehicle of id `${vehicleId}` was viewed.");

        return $this->respondWithJSON($vehicle);
    }
}
