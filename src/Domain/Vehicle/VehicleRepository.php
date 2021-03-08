<?php

namespace App\Domain\Vehicle;

use PDO;

/**
 * Repository.
 */
class VehicleRepository
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
     * Convert an associative array to a Vehicle object
     *
     * @param array $data
     *
     * @return Vehicle
     */
    public function convertArrayToObject(array $data): Vehicle
    {
        $vehicle = new Vehicle();
        $vehicle->loadFromData($data);

        return $vehicle;
    }

    /**
     * Get all vehicle rows active depending on the filters.
     *
     * @param $filters
     * @return array
     * @throws VehicleFiltersException
     * @throws VehicleListNotFoundException
     */
    public function findAll($filters): array
    {
        $list = [0 => 'make', 1 => 'model', 2 => 'year'];

        if (isset($filters)) {
            foreach (array_keys($filters) as $key) {
                if (array_search($key, $list) === false) {
                    throw new VehicleFiltersException();
                }
            }
        }
        $sql = "SELECT 
                    v.vehicle_id as vehicle_id, 
                    v.vehicle_year as vehicle_year, 
                    v.created as vehicle_created, 
                    v.updated as vehicle_updated, 
                    v.state as vehicle_state, 
                    vmo.name as vehicle_model_name, 
                    vma.name as vehicle_make_name, 
                    vma.url as vehicle_make_url, 
                    vma.state as vehicle_make_state
                FROM vehicle v
                JOIN vehicle_model vmo ON v.vehicle_model_id = vmo.vehicle_model_id
                JOIN vehicle_make vma ON v.vehicle_make_id = vma.vehicle_make_id
                WHERE v.state = 1 ";
        if (isset($filters['model'])) {
            $sql .= "And vmo.name = '{$filters['model']}'";
        }
        if (isset($filters['year'])) {
            $sql .= "And v.vehicle_year = '{$filters['year']}'";
        }
        if (isset($filters['make'])) {
            $sql .= "And vma.name = '{$filters['make']}'";
        }

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll();

        if (!count($records)) {
            throw new VehicleListNotFoundException();
        }

        return array_map(function ($record) {
            return $this->convertArrayToObject($record)->jsonSerialize();
        }, $records);
    }

    /**
     * Find one row.
     *
     * @param int $vehicleId The vehicle ID
     *
     * @return array The new ID
     * @throws VehicleNotFoundException
     */
    public function findOne(int $vehicleId): array
    {
        $row = ['vehicle_id' => $vehicleId];

        $sql = "SELECT 
                    v.vehicle_id as vehicle_id, 
                    v.vehicle_year as vehicle_year, 
                    v.created as vehicle_created, 
                    v.updated as vehicle_updated, 
                    v.state as vehicle_state, 
                    vmo.name as vehicle_model_name, 
                    vma.name as vehicle_make_name, 
                    vma.url as vehicle_make_url, 
                    vma.state as vehicle_make_state
                FROM vehicle v
                JOIN vehicle_model vmo ON v.vehicle_model_id = vmo.vehicle_model_id
                JOIN vehicle_make vma ON v.vehicle_make_id = vma.vehicle_make_id
                WHERE vehicle_id=:vehicle_id;";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($row);

        $record = $stmt->fetch();

        if (!$record) {
            throw new VehicleNotFoundException();
        }

        return $this->convertArrayToObject($record)->jsonSerialize();
    }

    /**
     * Add one row.
     *
     * @param int $vehicleId The vehicle  ID
     * @param $vehicle
     * @return array The new ID
     * @throws VehicleNotFoundException|VehicleParamMissingException
     */
    public function addVehicle($vehicle): array
    {
        if (!isset($vehicle['vehicle_make_id']) || !isset($vehicle['vehicle_model_id']) || !isset($vehicle['vehicle_year'])) {
            throw new VehicleParamMissingException();
        }

        try {
            $sql = "INSERT INTO vehicle (
                          vehicle_make_id,
                          vehicle_model_id,
                          vehicle_year,
                          created)
                VALUES (
                        '{$vehicle['vehicle_make_id']}',
                        '{$vehicle['vehicle_model_id']}',
                        '{$vehicle['vehicle_year']}',
                        CURRENT_TIMESTAMP()
                        )";

            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $record = $stmt->rowCount();

            if (!$record) {
                throw new VehicleNotFoundException();
            }

            return $this->findOne($this->connection->lastInsertId());
        }
        catch (\Exception $exception){
            throw new VehicleExistingException();
        }

    }

    /**
     * Update one row.
     *
     * @param int $vehicleId The vehicle  ID
     * @param $vehicle
     * @return array The new ID
     * @throws VehicleNotFoundException
     */
    public function setDeleteVehicle(int $vehicleId): array
    {
        $row = [
            'vehicle_id' => $vehicleId,
        ];

        $sql = "UPDATE vehicle
                SET state = 0,
                    updated = CURRENT_TIMESTAMP()
                WHERE vehicle_id =:vehicle_id ";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($row);
        $record =$stmt->rowCount();

        if (!$record) {
            throw new VehicleNotFoundException();
        }

        return $this->findOne($vehicleId);
    }

}