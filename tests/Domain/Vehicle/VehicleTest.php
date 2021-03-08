<?php
declare(strict_types=1);

namespace Tests\Domain\Vehicle;

use App\Domain\Vehicle\Vehicle;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    public function vehicleProvider()
    {
        return [
            [1, 'Acura', 'Integra',1988, 1, '',''],
            [2, 'Acura', 'Legend',1988, 1, '',''],
            [1, 'Acura', 'Integra',1989, 1, '',''],

        ];
    }

    /**
     * @dataProvider vehicleProvider
     * @param int $id
     * @param string $make
     * @param string $model
     * @param int $year
     * @param int $state
     * @param string $created
     * @param string $updated
     */
    public function testGetters(int $id, string $make, string $model, int $year, int $state, string $created, string $updated)
    {
        $vehicle = new Vehicle();
        $vehicle->setId($id);
        $vehicle->setMake($make);
        $vehicle->setModel($model);
        $vehicle->setYear($year);
        $vehicle->setState($state);
        $vehicle->setCreated($created);
        $vehicle->setupdated($updated);

        $this->assertEquals($id, $vehicle->getId());
        $this->assertEquals($make, $vehicle->getMake());
        $this->assertEquals($model, $vehicle->getModel());
        $this->assertEquals($year, $vehicle->getYear());
        $this->assertEquals($state, $vehicle->getState());
        $this->assertEquals($created, $vehicle->getCreated());
        $this->assertEquals($updated, $vehicle->getupdated());
    }

    /**
     * @dataProvider vehicleProvider
     * @param int $id
     * @param string $make
     * @param string $model
     * @param int $year
     * @param int $state
     * @param string $created
     * @param string $updated
     */
    public function testJsonSerialize(int $id, string $make, string $model, int $year, int $state, string $created, string $updated)
    {
        $vehicle = new Vehicle();
        $vehicle->setId($id);
        $vehicle->setMake($make);
        $vehicle->setModel($model);
        $vehicle->setYear($year);
        $vehicle->setState($state);
        $vehicle->setCreated($created);
        $vehicle->setupdated($updated);

        $expectedPayload = json_encode([
            'id' => $id,
            'make' => $make,
            'model' => $model,
            'year' => $year,
            'state' => $state,
            'created' => $created,
            'updated' => $updated,
        ]);

        $this->assertEquals($expectedPayload, json_encode($vehicle));
    }
}
