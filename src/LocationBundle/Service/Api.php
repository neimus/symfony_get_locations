<?php
/**
 * Created by PhpStorm.
 * User: Saburov Denis
 * Date: 17.11.17
 */

namespace LocationBundle\Service;

use LocationBundle\Entity\LocationEntity;
use RequestBundle\Exception\ResponseException;
use RequestBundle\Service\ClientInterface;

/**
 * Class Api
 * @package LocationBundle\Service
 */
class Api
{
    /**
     * @var \RequestBundle\Service\ClientInterface
     */
    private $client;

    /**
     * @var \LocationBundle\Service\LocationSerializer
     */
    private $serializer;

    /**
     * @var string
     */
    private $uri;

    /**
     * Api constructor.
     *
     * @param $client \RequestBundle\Service\ClientInterface
     * @param $serializer \LocationBundle\Service\LocationSerializer
     */
    public function __construct($client, $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;
        $this->uri = '127.0.0.1';
    }

    /**
     * @param $uri string
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return LocationEntity
     *
     * @throws \RequestBundle\Exception\RequestException
     * @throws \RequestBundle\Exception\ResponseException
     * @throws \Symfony\Component\Serializer\Exception\UnexpectedValueException
     * @throws \LocationBundle\Exception\ValidationFailedException
     * @throws \LogicException
     * @throws \Exception
     */
    public function getLocation(): LocationEntity
    {
        $response = $this->client->get($this->uri);
        if ($response->getStatusCode() !== ClientInterface::HTTP_CODE_STATUS) {
            throw new ResponseException('The server responded with an error '.$response->getStatusCode(), 0);
        }

        $entity = $this->serializer->deserialize($response->getBody());

        if (!$entity->getSuccess()) {
            $code = $entity->getCode() ?? -1;
            $message = $entity->getMessage() ?? 'Unknown error';

            throw new ResponseException($message, $code);
        }

        return $entity;
    }
}