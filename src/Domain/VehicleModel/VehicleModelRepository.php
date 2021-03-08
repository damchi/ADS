<?php

namespace App\Domain\VehicleModel;

use PDO;

/**
 * Repository.
 */
class VehicleModelRepository
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
     * Convert an associative array to a VehicleModel object
     *
     * @param array $data
     *
     * @return VehicleModel
     */
    public function convertArrayToObject(array $data): VehicleModel
    {
        $vehicleModel = new VehicleModel();
        $vehicleModel->loadFromData($data);

        return $vehicleModel;
    }

    /**
     * Get all vehicle models rows.
     *
     * @return array 
     */
    public function findAll(): array
    {
        $sql = "SELECT * FROM vehicle_model;";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll();

        if (!count($records)) {
            throw new VehicleModelsListNotFoundException();
        }

        return array_map(function($record) {
            return $this->convertArrayToObject($record)->jsonSerialize();
        }, $records);
    }

    /**
     * Find one row.
     *
     * @param int $vehicleModelId The vehicle model ID
     *
     * @return array The new ID
     */
    public function findOne(int $vehicleModelId): array
    {
        $row = ['vehicle_model_id' => $vehicleModelId];

        $sql = "SELECT * 
                FROM vehicle_model 
                WHERE 
                    vehicle_model_id=:vehicle_model_id;";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($row);

        $record = $stmt->fetch();

        if (!$record) {
            throw new VehicleModelNotFoundException();
        }

        return $this->convertArrayToObject($record)->jsonSerialize();
    }
}