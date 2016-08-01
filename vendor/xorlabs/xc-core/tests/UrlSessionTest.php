<?php

namespace XORLabs\XC;
use XORLabs\XC\Url_session;

if ( ! isset($_SESSION)) $_SESSION = ['xc_url_session'=>(object)['urls'=>[]]];

class UrlSessionTest extends \PHPUnit_Framework_TestCase {

  public function testRecordCanBeRetrieved() {
    $this->assertEquals(true, Url_session::valid('/home'));
  }

}
