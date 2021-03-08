<?php
declare(strict_types=1);

namespace App\Application\Actions\Vehicle;

use App\Application\Actions\Action;
use App\Domain\Vehicle\VehicleRepository;
use Psr\Log\LoggerInterface;

abstract class VehicleAction extends Action
{
    /**
     * @var VehicleRepository
     */
    protected $vehicleRepository;

    /**
     * @param LoggerInterface $logger
     * @param VehicleRepository $vehicleRepository
     */
    public function __construct(LoggerInterface $logger,
                                VehicleRepository $vehicleRepository
    ) {
        parent::__construct($logger);
        $this->vehicleRepository = $vehicleRepository;
    }
}
