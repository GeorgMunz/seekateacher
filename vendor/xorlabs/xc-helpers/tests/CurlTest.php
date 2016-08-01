<?php
namespace XORLabs\XC\Helpers;

class CurlTest extends \PHPUnit_Framework_TestCase {

  public function testGet() {
    $response = Curl::get('http://cricapi.com/api/cricket/');

    $this->assertRegexp('/{.*}/', $response);
  }

}
