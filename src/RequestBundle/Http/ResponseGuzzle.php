<?php
/**
 * Created by PhpStorm.
 * User: Saburov Denis
 * Date: 17.11.17
 */

namespace RequestBundle\Http;

use RequestBundle\Exception\ResponseException;

/**
 * Class ResponseGuzzle
 * @package RequestBundle\Http
 */
class ResponseGuzzle implements ResponseInterface
{
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;

    public function __construct($response)
    {
        $this->response = $response;
    }

    /**
     * @inheritdoc
     */
    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    /**
     * @inheritdoc
     */
    public function getHeaders(): array
    {
        return $this->response->getHeaders();
    }

    /**
     * @inheritdoc
     *
     * @throws ResponseException
     */
    public function getBody(): string
    {
        try {
            return $this->response->getBody()->getContents();
        } catch (\RuntimeException $exception) {
            throw new ResponseException($exception->getMessage(), 0, $exception);
        }
    }
}