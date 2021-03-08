<?php
declare(strict_types=1);


namespace App\Application\Actions\Vehicle;

use Psr\Http\Message\ResponseInterface as Response;

class AddVehicleAction extends VehicleAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        try {
            $input = $this->request->getBody()->getContents();
            $vehicle = json_decode($input, true);

            $vehicleMake = $this->vehicleRepository->addVehicle($vehicle);

            $this->logger->info("Vehicle added");

            return $this->respondWithJSON($vehicleMake);
        } catch (\Exception $exception) {
            throw new $exception;
        }

    }

}