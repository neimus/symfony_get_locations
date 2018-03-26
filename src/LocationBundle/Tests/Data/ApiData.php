<?php
/**
 * Created by PhpStorm.
 * User: Saburov Denis
 * Date: 17.11.17
 */

namespace LocationBundle\Tests\Data;

/**
 * Class ApiData
 * @package LocationBundle\Tests\Data
 */
class ApiData
{
    /**
     * @param $fileName string
     *
     * @return bool|string
     */
    public static function get($fileName)
    {
        return file_get_contents(__DIR__.DIRECTORY_SEPARATOR.$fileName);
    }
}