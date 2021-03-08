<?php
declare(strict_types=1);

namespace App\Application\Actions\VehicleModel;

use App\Application\Actions\Action;
use App\Domain\VehicleModel\VehicleModelRepository;
use Psr\Log\LoggerInterface;

abstract class VehicleModelAction extends Action
{
    /**
     * @var VehicleModelRepository
     */
    protected $vehicleModelRepository;

    /**
     * @param LoggerInterface $logger
     * @param VehicleModelRepository $vehicleModelRepository
     */
    public function __construct(LoggerInterface $logger,
                                VehicleModelRepository $vehicleModelRepository
    ) {
        parent::__construct($logger);
        $this->vehicleModelRepository = $vehicleModelRepository;
    }
}
