<?php

namespace XORLabs\PHP\DP;

class SingletonTest extends \PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $this->assertTrue(
          method_exists(new SingletonClass(), 'get_instance'),
          'Class does not have method get_instance'
        );
    }
}

class SingletonClass
{
    use Singleton;
}
