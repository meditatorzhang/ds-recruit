<?php
namespace Tests\Src;

use PHPUnit\Framework\TestCase;
use Src\MyGreeter;

class MyGreeterTest extends TestCase
{
    private MyGreeter $greeter;

    public function setUp(): void
    {
        $this->greeter      = new MyGreeter();
    }

    public function test_init()
    {
        $this->assertInstanceOf(
            MyGreeter::class,
            $this->greeter
        );
    }

    public function test_greeting()
    {
        $this->assertTrue(
            strlen($this->greeter->greeting()) > 0
        );

        $this->assertTrue(
            strcmp($this->greeter->greeting(0), 'Good evening') === 0
        );

        $this->assertTrue(
            strcmp($this->greeter->greeting(6), 'Good morning') === 0
        );

        $this->assertTrue(
            strcmp($this->greeter->greeting(12), 'Good afternoon') === 0
        );

        $this->assertTrue(
            strcmp($this->greeter->greeting(18), 'Good evening') === 0
        );
    }
}
