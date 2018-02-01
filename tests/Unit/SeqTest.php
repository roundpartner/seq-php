<?php

namespace Test\Unit;

use RoundPartner\Seq\Seq;

use \PHPUnit\Framework\TestCase;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class SeqTest extends TestCase
{
    /**
     * @var Seq
     */
    protected $instance;

    public function setUp()
    {
        $this->instance = new Seq('http://0.0.0.0:6060', 'an example key');
    }

    public function testInit()
    {
        $this->assertInstanceOf('\RoundPartner\Seq\Seq', $this->instance);
    }

    /**
     * @param Response[] $responses
     *
     * @dataProvider \Test\Provider\ResponseProvider::get()
     */
    public function testGet($responses)
    {
        $client = $this->getClientMock($responses);
        $this->instance->setClient($client);
        $response = $this->instance->get();
        $this->assertNotNull($response);
    }

    /**
     * @param Response[] $responses
     *
     * @dataProvider \Test\Provider\ResponseProvider::getInvalidHMAC()
     */
    public function testGetHMACInvalid($responses)
    {
        $client = $this->getClientMock($responses);
        $this->instance->setClient($client);
        $response = $this->instance->get();
        $this->assertNull($response);
    }

    /**
     * @param Response[] $responses
     *
     * @dataProvider \Test\Provider\ResponseProvider::getEmpty()
     */
    public function testGetEmpty($responses)
    {
        $client = $this->getClientMock($responses);
        $this->instance->setClient($client);
        $response = $this->instance->get();
        $this->assertNull($response);
    }

    /**
     * @param Response[] $responses
     *
     * @dataProvider \Test\Provider\ResponseProvider::post()
     */
    public function testPost($responses)
    {
        $client = $this->getClientMock($responses);
        $this->instance->setClient($client);
        $response = $this->instance->post([]);
        $this->assertTrue($response);
    }

    /**
     * @param Response[] $responses
     *
     * @dataProvider \Test\Provider\ResponseProvider::delete()
     */
    public function testDelete($responses)
    {
        $client = $this->getClientMock($responses);
        $this->instance->setClient($client);
        $response = $this->instance->delete(1);
        $this->assertTrue($response);
    }


    /**
     * @param Response[] $responses
     *
     * @dataProvider \Test\Provider\ResponseProvider::deleteNotFound()
     */
    public function testDeleteNotFound($responses)
    {
        $client = $this->getClientMock($responses);
        $this->instance->setClient($client);
        $response = $this->instance->delete(1);
        $this->assertFalse($response);
    }

    /**
     * @param Response[] $responses
     *
     * @return Client
     */
    protected function getClientMock($responses)
    {
        $mock = new MockHandler($responses);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        return $client;
    }
}
