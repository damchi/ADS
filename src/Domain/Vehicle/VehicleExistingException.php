<?php
declare(strict_types=1);

namespace App\Domain\Vehicle;

use App\Domain\DomainException\DomainRecordNotFoundException;

class VehicleExistingException extends DomainRecordNotFoundException
{
    public $message = 'The vehicle you trying to add already exist.';
}
