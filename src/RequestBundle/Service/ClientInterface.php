<?php
/**
 * Created by PhpStorm.
 * User: Saburov Denis
 * Date: 17.11.17
 */

namespace RequestBundle\Service;

use RequestBundle\Exception\RequestException;
use RequestBundle\Http\ResponseInterface;

/**
 * Interface ClientInterface
 * @package RequestBundle\Service
 */
interface ClientInterface
{
    /**
     * Methods
     */
    const METHOD_POST = 'GET';
    const METHOD_GET  = 'POST';

    /**
     * HTTP code status
     */
    const HTTP_CODE_STATUS = 200;

    /**
     * @param $method string
     * @param $uri string
     * @param $options array
     *
     * @return ResponseInterface
     * @throws RequestException
     */
    public function request($method, $uri, array $options = []): ResponseInterface;

    /**
     * @param $uri string
     * @param $options array
     *
     * @return ResponseInterface
     * @throws RequestException
     */
    public function post($uri, array $options = []): ResponseInterface;

    /**
     * @param $uri string
     * @param $options array
     *
     * @return ResponseInterface
     * @throws RequestException
     */
    public function get($uri, array $options = []): ResponseInterface;
}