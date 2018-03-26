<?php
/**
 * Created by PhpStorm.
 * User: Saburov Denis
 * Date: 17.11.17
 */

namespace RequestBundle\Service;

use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\RequestOptions as Options;
use GuzzleHttp\Client as GuzzleClient;
use RequestBundle\Exception\RequestException;
use RequestBundle\Http\ResponseGuzzle;
use RequestBundle\Http\ResponseInterface;

/**
 * Class ClientGuzzle
 * @package RequestBundle\Service
 */
class ClientGuzzle implements ClientInterface
{
    const HTTP_TIMEOUT         = 7;
    const HTTP_CONNECT_TIMEOUT = 7;

    /**
     * @var GuzzleClient
     */
    private $client;

    /**
     * ClientGuzzle constructor.
     */
    public function __construct()
    {
        $this->client = $this->createClientGuzzle();
    }

    /**
     * @param $method string
     * @param $uri string
     * @param $options array
     *
     * @return \RequestBundle\Http\ResponseInterface
     * @throws RequestException
     */
    public function request($method, $uri, array $options = []): ResponseInterface
    {
        try {
            return new ResponseGuzzle($this->client->request($method, $uri, $options));
        } catch (TransferException $exception) {
            throw new RequestException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * @param string $uri
     * @param array $options
     *
     * @return \RequestBundle\Http\ResponseInterface
     * @throws \RequestBundle\Exception\RequestException
     */
    public function post($uri, array $options = []): ResponseInterface
    {
        return $this->request(self::METHOD_POST, $uri, $options);
    }

    /**
     * @param string $uri
     * @param array $options
     *
     * @return \RequestBundle\Http\ResponseInterface
     * @throws \RequestBundle\Exception\RequestException
     */
    public function get($uri, array $options = []): ResponseInterface
    {
        return $this->request(self::METHOD_GET, $uri, $options);
    }

    /**
     * @return GuzzleClient
     */
    private function createClientGuzzle(): GuzzleClient
    {
        $options = [
            Options::VERIFY          => false,
            Options::HTTP_ERRORS     => false,
            Options::TIMEOUT         => self::HTTP_TIMEOUT,
            Options::CONNECT_TIMEOUT => self::HTTP_CONNECT_TIMEOUT,
            Options::DEBUG           => true,
            Options::ALLOW_REDIRECTS => false,
        ];

        return new GuzzleClient($options);
    }
}