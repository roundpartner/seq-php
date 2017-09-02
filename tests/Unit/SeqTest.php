<?php

namespace Test\Unit;

use RoundPartner\Seq\Seq;

class SeqTest extends \PHPUnit\Framework\TestCase
{
    public function testInit()
    {
        $instance = new Seq();
        $this->assertInstanceOf('\RoundPartner\Seq\Seq', $instance);
    }
}
