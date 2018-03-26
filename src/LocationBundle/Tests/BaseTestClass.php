<?php
/**
 * Created by PhpStorm.
 * User: Saburov Denis
 * Date: 17.11.17
 */

namespace LocationBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class BaseTestClass
 * @package LocationBundle\Tests
 */
class BaseTestClass extends WebTestCase
{
    /**
     * @var \Symfony\Bundle\FrameworkBundle\Client
     */
    public $client;

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    public $container;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->initializeHelpers();
    }

    protected function initializeHelpers()
    {
        $this->client = static::createClient();
        $this->client->enableProfiler();
        $this->container = $this->client->getContainer();
    }
}