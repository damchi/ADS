<?php
declare(strict_types=1);

namespace App\Domain\VehicleModel;

use JsonSerializable;

class VehicleModel implements JsonSerializable
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $updated;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->id = 0;
        $this->name = '';
        $this->updated = '';
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param $name string
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getupdated(): string
    {
        return $this->updated;
    }

    /**
     * @param $updated string
     */
    public function setupdated(string $updated): void
    {
        $this->updated = $updated;
    }

    /**
     * @param $data array
     */
    public function loadFromData(array $data): void
    {
        if (array_key_exists('vehicle_model_id', $data) && $data['vehicle_model_id'] != null) {
            $this->setId((int)$data['vehicle_model_id']);
        }

        if (array_key_exists('name', $data) && $data['name'] != null) {
            $this->setName($data['name']);
        }

        if (array_key_exists('created', $data) && $data['created'] != null) {
            $this->setupdated($data['created']);
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'updated' => $this->getupdated(),
        ];
    }
}
