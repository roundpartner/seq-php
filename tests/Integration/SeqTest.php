<?php

namespace Test\Integration;

use RoundPartner\Seq\Seq;

use \PHPUnit\Framework\TestCase;

class SeqTest extends TestCase
{
    /**
     * @var Seq
     */
    protected $instance;

    public function setUp()
    {
        $this->instance = new Seq();
        do {
            $response = $this->instance->get();
        } while($response);
    }

    public function testGetEmpty()
    {
        $response = $this->instance->get();
        $this->assertNull($response);
    }

    /**
     * @param string $json
     *
     * @dataProvider \Test\Provider\JsonProvider::validJson()
     */
    public function testPost($json)
    {
        $response = $this->instance->post($json);
        $this->assertTrue($response);
    }

    /**
     * @param string $json
     * @param callable $test
     * @param string $cmp
     *
     * @dataProvider \Test\Provider\JsonProvider::validJson()
     */
    public function testGet($json, $test, $cmp)
    {
        $this->instance->post($json);
        $response = $this->instance->get();
        $result = $test($response[0]->body);
        $this->assertEquals($cmp, $result);
    }

    /**
     * @param string $json
     *
     * @dataProvider \Test\Provider\JsonProvider::validJson()
     */
    public function testDelete($json)
    {
        $this->instance->post($json);
        $response = $this->instance->get();
        $response = $this->instance->delete($response[0]->id);
        $this->assertTrue($response);
    }

    public function testDeleteNotFound()
    {
        $this->instance->delete(1);
        $response = $this->instance->delete(1);
        $this->assertFalse($response);
    }
}
