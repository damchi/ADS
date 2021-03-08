<?php
declare(strict_types=1);


namespace App\Application\Actions\VehicleMake;

use Psr\Http\Message\ResponseInterface as Response;

class RemoveVehicleMakeAction extends VehicleMakeAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $vehicleMakeId = $this->request->getAttribute('id');

        $vehicleMake = $this->vehicleMakeRepository->setDeleteVehicleMaKe(intval($vehicleMakeId));

        $this->logger->info("Vehicle makes deleted:" . $vehicleMakeId);

        return $this->respondWithJSON($vehicleMake);
    }

}