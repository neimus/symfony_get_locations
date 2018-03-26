<?php
/**
 * Created by PhpStorm.
 * User: Saburov Denis
 * Date: 17.11.17
 */

namespace LocationBundle\Tests\Unit;

use LocationBundle\Exception\ValidationFailedException;
use LocationBundle\Tests\BaseTestClass;
use LocationBundle\Tests\Data\ApiData;

/**
 * Class LocationDeserializeTest
 * @package LocationBundle\Tests\Unit
 */
class LocationDeserializeTest extends BaseTestClass
{
    /**
     * @var \LocationBundle\Service\LocationSerializer
     */
    private $serializer;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        parent::setUp();
        $this->serializer = $this->container->get('app.location.serializer');
    }

    /**
     * @throws \LocationBundle\Exception\ValidationFailedException
     */
    public function testSuccessResponse()
    {
        $jsonString = ApiData::get('locationSuccess.json');
        $response = $this->serializer->deserialize($jsonString);
        $data = json_decode($jsonString, true);

        $this->assertEquals(null, $response->getMessage());
        $this->assertEquals(null, $response->getCode());
        $this->assertEquals(true, $response->getSuccess());
        $this->assertEquals($data['data']['locations'], $response->getLocations());
    }

    /**
     * @throws \LocationBundle\Exception\ValidationFailedException
     */
    public function testErrorResponse()
    {
        $jsonString = ApiData::get('locationError.json');
        $response = $this->serializer->deserialize($jsonString);
        $data = json_decode($jsonString, true);

        $this->assertEquals($data['data']['message'], $response->getMessage());
        $this->assertEquals($data['data']['code'], $response->getCode());
        $this->assertEquals(false, $response->getSuccess());
        $this->assertEquals([], $response->getLocations());
    }

    /**
     * @throws \LocationBundle\Exception\ValidationFailedException
     */
    public function testInvalidData()
    {
        $this->expectException(ValidationFailedException::class);
        $this->serializer->deserialize(ApiData::get('locationInvalidData.json'));
    }

    /**
     * @throws \LocationBundle\Exception\ValidationFailedException
     */
    public function testInvalidSuccess()
    {
        $this->expectException(ValidationFailedException::class);
        $this->serializer->deserialize(ApiData::get('locationInvalidSuccess.json'));
    }

}