<?php
declare(strict_types=1);

namespace App\Domain\VehicleModel;

use App\Domain\DomainException\DomainRecordNotFoundException;

class VehicleModelNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The vehicle model you requested does not exist.';
}
