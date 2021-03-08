<?php
declare(strict_types=1);

namespace App\Domain\Vehicle;

use App\Domain\DomainException\DomainRecordNotFoundException;

class VehicleFiltersException extends DomainRecordNotFoundException
{
    public $message = 'One of the filters is not correct. The available filters are: make, year,model';
}
