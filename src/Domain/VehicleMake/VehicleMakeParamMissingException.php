<?php
declare(strict_types=1);

namespace App\Domain\VehicleMake;

use App\Domain\DomainException\DomainRecordNotFoundException;

class VehicleMakeParamMissingException extends DomainRecordNotFoundException
{
    public $message = 'The vehicle name and url are required';
}
