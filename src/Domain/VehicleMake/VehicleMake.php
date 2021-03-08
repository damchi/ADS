<?php
declare(strict_types=1);

namespace App\Domain\VehicleMake;

use JsonSerializable;

class VehicleMake implements JsonSerializable
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
    private $url;

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
        $this->name = '';
        $this->url = '';
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
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param $url string
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
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
        if (array_key_exists('vehicle_make_id', $data) && $data['vehicle_make_id'] != null) {
            $this->setId((int)$data['vehicle_make_id']);
        }

        if (array_key_exists('name', $data) && $data['name'] != null) {
            $this->setName($data['name']);
        }

        if (array_key_exists('url', $data) && $data['url'] != null) {
            $this->setUrl($data['url']);
        }
        if (array_key_exists('created', $data) && $data['created'] != null) {
            $this->setCreated($data['created']);
        }
        if (array_key_exists('updated', $data) && $data['updated'] != null) {
            $this->setUpdated($data['updated']);
        }
        if (array_key_exists('state', $data) && $data['state'] != null) {
            $this->setState((int)$data['state']);
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
            'url' => $this->getUrl(),
            'state' => $this->getState(),
            'created' => $this->getCreated(),
            'updated' => $this->getUpdated(),
        ];
    }
}
