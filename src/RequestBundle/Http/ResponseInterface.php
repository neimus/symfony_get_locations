<?php
/**
 * Created by PhpStorm.
 * User: Saburov Denis
 * Date: 17.11.17
 */

namespace RequestBundle\Http;

use RequestBundle\Exception\ResponseException;

/**
 * Interface ResponseInterface
 * @package RequestBundle\Http
 */
interface ResponseInterface
{
    /**
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * @return string[][]
     */
    public function getHeaders(): array;

    /**
     * @return string
     *
     * @throws ResponseException
     */
    public function getBody(): string;
}