<?php
declare(strict_types=1);

namespace App\Application\Actions\VehicleModel;

use Psr\Http\Message\ResponseInterface as Response;

class ListVehicleModelsAction extends VehicleModelAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $vehicleModels = $this->vehicleModelRepository->findAll();

        $this->logger->info("Vehicle models list was viewed.");

        return $this->respondWithJSON(['vehicle-model' => $vehicleModels]);
    }
}
