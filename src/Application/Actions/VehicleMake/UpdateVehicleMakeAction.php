<?php
declare(strict_types=1);


namespace App\Application\Actions\VehicleMake;

use Psr\Http\Message\ResponseInterface as Response;

class UpdateVehicleMakeAction extends VehicleMakeAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $input = $this->request->getBody()->getContents();
        $vehicleMakeId = $this->request->getAttribute('id');
        $vehicle = json_decode($input, true);

        $vehicleMake = $this->vehicleMakeRepository->updateVehicleMaKe(intval($vehicleMakeId), $vehicle);

        $this->logger->info("Vehicle makes updated:" . $vehicleMakeId);

        return $this->respondWithJSON($vehicleMake);
    }

}