<?php

namespace App\Domain\VehicleMake;

use PDO;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * Repository.
 */
class VehicleMakeRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Convert an associative array to a VehicleMake object
     *
     * @param array $data
     *
     * @return VehicleMake
     */
    public function convertArrayToObject(array $data): VehicleMake
    {
        $vehicleMake = new VehicleMake();
        $vehicleMake->loadFromData($data);

        return $vehicleMake;
    }

    /**
     * Get all vehicle make rows.
     *
     * @return array 
     */
    public function findAll(): array
    {
        $sql = "SELECT * FROM vehicle_make;";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll();

        if (!count($records)) {
            throw new VehicleMakeListNotFoundException();
        }

        return array_map(function($record) {
            return $this->convertArrayToObject($record)->jsonSerialize();
        }, $records);
    }

    /**
     * Find one row.
     *
     * @param int $vehicleMakeId The vehicle make ID
     *
     * @return array The new ID
     * @throws VehicleMakeNotFoundException
     */
    public function findOne(int $vehicleMakeId): array
    {
        $row = ['vehicle_make_id' => $vehicleMakeId];

        $sql = "SELECT * 
                FROM vehicle_make 
                WHERE 
                    vehicle_make_id=:vehicle_make_id;";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($row);

        $record = $stmt->fetch();


        if (!$record) {
            throw new VehicleMakeNotFoundException();
        }

        return $this->convertArrayToObject($record)->jsonSerialize();
    }


    /**
     * Update one row.
     *
     * @param int $vehicleMakeId The vehicle make ID
     * @param $vehicle
     * @return array The new ID
     * @throws VehicleMakeNotFoundException
     */
    public function updateVehicleMaKe(int $vehicleMakeId,  $vehicle): array
    {
        $row = [
            'vehicle_make_id' => $vehicleMakeId,
        ];

        $sql = "UPDATE vehicle_make
                SET ";
        if(isset($vehicle['name'])){
            $sql .=" name = '{$vehicle['name']}',";
        }
        if(isset($vehicle['url'])){
            $sql .=" url = '{$vehicle['url']}', ";
        }
        $sql .="updated = CURRENT_TIMESTAMP()
                WHERE vehicle_make_id =:vehicle_make_id ";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($row);
        $record =$stmt->rowCount();

        if (!$record) {
            throw new VehicleMakeNotFoundException();
        }

        return $this->findOne($vehicleMakeId);
    }


    /**
     * Add one row.
     *
     * @param int $vehicleMakeId The vehicle make ID
     * @param $vehicle
     * @return array The new ID
     * @throws VehicleMakeNotFoundException|VehicleMakeParamMissingException
     */
    public function addVehicleMaKe($vehicle): array
    {
        if (!isset($vehicle['name']) || !isset($vehicle['url'])) {
            throw new VehicleMakeParamMissingException();
        }

        $sql = "INSERT INTO vehicle_make (
                          name,
                          url,
                          created)
                VALUES (
                        '{$vehicle['name']}',
                        '{$vehicle['url']}',
                        CURRENT_TIMESTAMP()
                        )";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $record =$stmt->rowCount();

        if (!$record) {
            throw new VehicleMakeNotFoundException();
        }

        return $this->findOne($this->connection->lastInsertId());
    }

    /**
     * Update one row.
     *
     * @param int $vehicleMakeId The vehicle make ID
     * @param $vehicle
     * @return array The new ID
     * @throws VehicleMakeNotFoundException
     */
    public function setDeleteVehicleMaKe(int $vehicleMakeId): array
    {
        $row = [
            'vehicle_make_id' => $vehicleMakeId,
        ];

        $sql = "UPDATE vehicle_make
                SET state = 0,
                    updated = CURRENT_TIMESTAMP()
                WHERE vehicle_make_id =:vehicle_make_id ";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($row);
        $record =$stmt->rowCount();

        if (!$record) {
            throw new VehicleMakeNotFoundException();
        }

        return $this->findOne($vehicleMakeId);
    }

}