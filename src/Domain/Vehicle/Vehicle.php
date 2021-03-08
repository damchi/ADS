<?php
declare(strict_types=1);

namespace App\Domain\Vehicle;

use JsonSerializable;

class Vehicle implements JsonSerializable
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string
     */
    private $make;

    /**
     * @var string
     */
    private $model;

    /**
     * @var int
     */
    private $year;

    /**
     * @var string
     */
    private $updated;
    /**
     * @var string
     */
    private $created;

    /**
     * @var int|null
     */
    private $state;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->id = 0;
        $this->make = '';
        $this->model = '';
        $this->year = '';
        $this->created = '';
        $this->updated = '';
        $this->state = 1;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param $id int
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getMake(): string
    {
        return $this->make;
    }

    /**
     * @param $make string
     */
    public function setMake(string $make): void
    {
        $this->make = $make;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param $model string
     */
    public function setModel(string $model): void
    {
        $this->model = $model;
    }
    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param $year int
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
    }
    /**
     * @return string
     */
    public function getCreated(): string
    {
        return $this->created;
    }

    /**
     * @param $created string
     */
    public function setCreated(string $created): void
    {
        $this->created = $created;
    }
    /**
     * @return string
     */
    public function getUpdated(): string
    {
        return $this->updated;
    }

    /**
     * @param $updated string
     */
    public function setUpdated(string $updated): void
    {
        $this->updated = $updated;
    }
    /**
     * @return string
     */
    public function getState(): int
    {
        return $this->state;
    }

    /**
     * @param $state int
     */
    public function setState(int $state): void
    {
        $this->state = $state;
    }

    /**
     * @param $data array
     */
    public function loadFromData(array $data): void
    {

        if (array_key_exists('vehicle_id', $data) && $data['vehicle_id'] != null) {
            $this->setId((int)$data['vehicle_id']);
        }

        if (array_key_exists('vehicle_model_name', $data) && $data['vehicle_model_name'] != null) {
            $this->setModel($data['vehicle_model_name']);
        }

        if (array_key_exists('vehicle_make_name', $data) && $data['vehicle_make_name'] != null) {
            $this->setMake($data['vehicle_make_name']);
        }

        if (array_key_exists('vehicle_year', $data) && $data['vehicle_year'] != null) {
            $this->setYear((int)$data['vehicle_year']);
        }

        if (array_key_exists('vehicle_created', $data) && $data['vehicle_created'] != null) {
            $this->setCreated($data['vehicle_created']);
        }
        if (array_key_exists('vehicle_updated', $data) && $data['vehicle_updated'] != null) {
            $this->setUpdated($data['vehicle_updated']);
        }
        if (array_key_exists('vehicle_state', $data) && $data['vehicle_state'] != null) {
            $this->setState((int)$data['vehicle_state']);
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'make' => $this->getMake(),
            'model' => $this->getModel(),
            'year' => $this->getYear(),
            'state' => $this->getState(),
            'created' => $this->getCreated(),
            'updated' => $this->getUpdated(),
        ];
    }
}
