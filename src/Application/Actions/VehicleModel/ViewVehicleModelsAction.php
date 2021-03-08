<?php
declare(strict_types=1);

namespace App\Application\Actions\VehicleModel;

use Psr\Http\Message\ResponseInterface as Response;

class ViewVehicleModelsAction extends VehicleModelAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $vehicleModelId = (int) $this->resolveArg('id');
        $vehicleModel = $this->vehicleModelRepository->findOne($vehicleModelId);

        $this->logger->info("Vehicle model of id `${vehicleModelId}` was viewed.");

        return $this->respondWithJSON($vehicleModel);
    }
}
