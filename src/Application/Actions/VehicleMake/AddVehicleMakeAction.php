<?php
declare(strict_types=1);


namespace App\Application\Actions\VehicleMake;

use Psr\Http\Message\ResponseInterface as Response;

class AddVehicleMakeAction extends VehicleMakeAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        try {
            $input = $this->request->getBody()->getContents();
            $vehicle = json_decode($input, true);

            $vehicleMake = $this->vehicleMakeRepository->addVehicleMaKe( $vehicle);

            $this->logger->info("Vehicle makes added");

            return $this->respondWithJSON($vehicleMake);
        } catch (\Exception $exception) {
            throw new $exception;
        }

    }

}