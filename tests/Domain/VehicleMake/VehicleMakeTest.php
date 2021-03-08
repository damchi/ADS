<?php
declare(strict_types=1);

namespace Tests\Domain\VehicleMake;

use App\Domain\VehicleMake\VehicleMake;
use Tests\TestCase;

class VehicleMakeTest extends TestCase
{
    public function vehicleMakeProvider()
    {
        return [
            [1, 'Mercedes', 'mercedes.com', 1, '', ''],
            [2, 'Renault', 'renault.fr', 1, '', ''],
            [3, 'Mini', 'mini.de', 1, '', ''],
        ];
    }

    /**
     * @dataProvider vehicleMakeProvider
     * @param int $id
     * @param string $name
     * @param string $url
     * @param string $updated
     * @param int $state
     * @param string $created
     */
    public function testGetters(int $id, string $name, string $url, int $state,string $updated,  string $created)
    {
        $vehicleMake = new VehicleMake();
        $vehicleMake->setId($id);
        $vehicleMake->setName($name);
        $vehicleMake->setUrl($url);
        $vehicleMake->setState($state);
        $vehicleMake->setCreated($created);
        $vehicleMake->setUpdated($updated);

        $this->assertEquals($id, $vehicleMake->getId());
        $this->assertEquals($name, $vehicleMake->getName());
        $this->assertEquals($url, $vehicleMake->getUrl());
        $this->assertEquals($state, $vehicleMake->getState());
        $this->assertEquals($created, $vehicleMake->getCreated());
        $this->assertEquals($updated, $vehicleMake->getUpdated());
    }

    /**
     * @dataProvider vehicleMakeProvider
     * @param int $id
     * @param string $name
     * @param string $url
     * @param string $updated
     * @param int $state
     * @param string $created
     */
    public function testJsonSerialize(int $id, string $name, string $url,  int $state, string $updated, string $created)
    {
        $vehicleMake = new VehicleMake();
        $vehicleMake->setId($id);
        $vehicleMake->setName($name);
        $vehicleMake->setUrl($url);
        $vehicleMake->setState($state);
        $vehicleMake->setCreated($created);
        $vehicleMake->setUpdated($updated);


        $expectedPayload = json_encode([
            'id' => $id,
            'name' => $name,
            'url' => $url,
            'state' => $state,
            'created' => $created,
            'updated' => $updated,
        ]);

        $this->assertEquals($expectedPayload, json_encode($vehicleMake));
    }
}
