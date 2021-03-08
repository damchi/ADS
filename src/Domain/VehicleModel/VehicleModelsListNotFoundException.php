<?php
declare(strict_types=1);

namespace App\Domain\VehicleModel;

use App\Domain\DomainException\DomainRecordNotFoundException;

class VehicleModelsListNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The vehicle models list you requested does not exist.';
}
