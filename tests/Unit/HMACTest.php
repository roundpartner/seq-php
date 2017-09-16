<?php

namespace Test\Unit;

use RoundPartner\Seq\HMAC;

use \PHPUnit\Framework\TestCase;

class HMACTest extends TestCase
{
    /**
     * @var HMAC
     */
    protected $instance;

    public function setUp()
    {
        $this->instance = new HMAC('a random key');
    }

    public function testGenerate()
    {
        $result = $this->instance->generate('hello world');
        $this->assertInternalType('string', $result);
    }

    public function testGenerateHash()
    {
        $result = $this->instance->generate('hello world');
        $this->assertEquals('dyxrL7pR5e5Lebd1jY0igOdcZ8q6i4M53Zdgry6MYg0=', $result);
    }

    public function testValidate()
    {
        $result = $this->instance->validate('hello world', 'dyxrL7pR5e5Lebd1jY0igOdcZ8q6i4M53Zdgry6MYg0=');
        $this->assertTrue($result);
    }

    public function testValidateInvalid()
    {
        $result = $this->instance->validate('goodbye world', 'dyxrL7pR5e5Lebd1jY0igOdcZ8q6i4M53Zdgry6MYg0=');
        $this->assertFalse($result);
    }
}
