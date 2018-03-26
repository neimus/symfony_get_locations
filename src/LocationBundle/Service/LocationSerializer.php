<?php
/**
 * Created by PhpStorm.
 * User: Saburov Denis
 * Date: 17.11.17
 */

namespace LocationBundle\Service;

use LocationBundle\Entity\LocationEntity;
use LocationBundle\Exception\ValidationFailedException;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Serializer;

/**
 * Class LocationSerializer
 * @package LocationBundle\Service
 */
class LocationSerializer
{
    /**
     * @var \Symfony\Component\Serializer\Serializer
     */
    private $serializer;

    /**
     * LocationSerializer constructor.
     *
     * @param \Symfony\Component\Serializer\Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param $jsonString string
     *
     * @return LocationEntity
     *
     * @throws UnexpectedValueException
     * @throws \LocationBundle\Exception\ValidationFailedException
     */
    public function deserialize($jsonString): LocationEntity
    {
        $data = json_decode($jsonString, true);
        if ($this->validate($data)) {
            /** @var LocationEntity $entity */
            $entity = $this->serializer->denormalize($data['data'], LocationEntity::class, 'json');
            $entity->setSuccess($data['success']);

            return $entity;
        }
        throw new ValidationFailedException('Invalid JSON format. No [data] or [success]');
    }

    /**
     * @param array $data
     *
     * @return string
     *
     * @throws UnexpectedValueException
     * @throws \LocationBundle\Exception\ValidationFailedException
     */
    public function serialize(array $data): string
    {
        if ($this->validate($data)) {
            return $this->serializer->serialize($data, 'json');
        }

        throw new ValidationFailedException('Invalid data. No [data] or [success]');
    }

    /**
     * @param $data array|bool|null
     *
     * @return bool
     */
    private function validate($data): bool
    {
        return is_array($data) && isset($data['data'], $data['success']);
    }

}