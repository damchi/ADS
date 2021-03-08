<?php
declare(strict_types=1);

namespace App\Domain\Vehicle;

use App\Domain\DomainException\DomainRecordNotFoundException;

class VehicleParamMissingException extends DomainRecordNotFoundException
{
    public $message = 'The vehicle_make_id, vehicle_model_id and vehicle_year are required';
}
