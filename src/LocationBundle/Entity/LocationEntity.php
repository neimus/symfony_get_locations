<?php
/**
 * Created by PhpStorm.
 * User: Saburov Denis
 * Date: 17.11.17
 */

namespace LocationBundle\Entity;

/**
 * Class LocationEntity
 * @package LocationBundle\Entity
 */
class LocationEntity
{
    /**
     * @var bool
     */
    private $success = false;

    /**
     * @var array
     */
    private $locations = [];

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $message;

    /**
     * @return bool
     */
    public function getSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @param bool $success
     *
     * @return $this
     */
    public function setSuccess($success)
    {
        $this->success = (bool)$success;

        return $this;
    }

    /**
     * @return array
     */
    public function getLocations(): array
    {
        return $this->locations;
    }

    /**
     * @param array $locations
     *
     * @return $this
     */
    public function setLocations(array $locations)
    {
        $this->locations = $locations;

        return $this;
    }

    /**
     * @param $location array
     */
    public function addLocation(array $location)
    {
        $this->locations[] = $location;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return (int)$this->code;
    }

    /**
     * @param null|string $code
     *
     * @return $this
     */
    public function setCode(?string $code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param null|string $errorMessage
     *
     * @return $this
     */
    public function setMessage(?string $errorMessage)
    {
        $this->message = $errorMessage;

        return $this;
    }
}