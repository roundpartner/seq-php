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
    }

    /**
     * @dataProvider \Test\Provider\ResponseProvider::getEmpty()
     */
    public function testGetEmpty()
    {
        $response = $this->instance->get();
        $this->assertNull($response);
    }

    /**
     * @dataProvider \Test\Provider\ResponseProvider::post()
     */
    public function testPost()
    {
        $response = $this->instance->post([]);
        $this->assertTrue($response);
    }

    /**
     * @dataProvider \Test\Provider\ResponseProvider::get()
     */
    public function testGet()
    {
        $response = $this->instance->get();
        $this->assertNotNull($response);
    }

    /**
     * @dataProvider \Test\Provider\ResponseProvider::delete()
     */
    public function testDelete()
    {
        $response = $this->instance->delete(1);
        $this->assertTrue($response);
    }

    /**
     * @dataProvider \Test\Provider\ResponseProvider::deleteNotFound()
     */
    public function testDeleteNotFound()
    {
        $response = $this->instance->delete(1);
        $this->assertFalse($response);
    }
}
