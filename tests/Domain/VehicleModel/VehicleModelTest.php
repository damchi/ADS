<?php
declare(strict_types=1);

namespace Tests\Domain\VehicleModel;

use App\Domain\VehicleMake\VehicleMake;
use App\Domain\VehicleModel\VehicleModel;
use Tests\TestCase;

class VehicleModelTest extends TestCase
{
    public function vehicleModelProvider()
    {
        return [
            [1, 'Integra', ''],
            [2, 'Legend',''],
            [3, 'A4', ''],
        ];
    }

    /**
     * @dataProvider vehicleModelProvider
     * @param int $id
     * @param string $name
     * @param string $updated
     */
    public function testGetters(int $id, string $name, string $updated)
    {
        $vehicleModel = new VehicleModel();
        $vehicleModel->setId($id);
        $vehicleModel->setName($name);
        $vehicleModel->setupdated($updated);

        $this->assertEquals($id, $vehicleModel->getId());
        $this->assertEquals($name, $vehicleModel->getName());
        $this->assertEquals($updated, $vehicleModel->getupdated());
    }

    /**
     * @dataProvider vehicleModelProvider
     * @param int $id
     * @param string $name
     * @param string $updated
     */
    public function testJsonSerialize(int $id, string $name, string $updated)
    {
        $vehicleModel = new VehicleModel();
        $vehicleModel->setId($id);
        $vehicleModel->setName($name);
        $vehicleModel->setupdated($updated);

        $expectedPayload = json_encode([
            'id' => $id,
            'name' => $name,
            'updated' => $updated,
        ]);

        $this->assertEquals($expectedPayload, json_encode($vehicleModel));
    }
}
