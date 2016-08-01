<?php
namespace XORLABS\XC;

use XORLabs\XC\View;

class ViewTest extends \PHPUnit_Framework_TestCase {

  public function testBodyClass() {
    $view = new View();
    $this->assertInstanceOf('XORLabs\XC\View\Body_classes', $view->bc);
  }

  public function testActiveClass() {
    $view = new View();
    $this->assertInstanceOf('XORLabs\XC\View\Active', $view->a);
  }

}
