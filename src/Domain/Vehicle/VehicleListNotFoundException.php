<?php
declare(strict_types=1);

namespace App\Domain\Vehicle;

use App\Domain\DomainException\DomainRecordNotFoundException;

class VehicleListNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The vehicle list you requested does not exist.';
}
