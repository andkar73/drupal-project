<?php
namespace Drupal\Tests\one_two\Unit;

use Drupal\Component\Utility\UrlHelper;
use Drupal\Tests\UnitTestCase;


/**
* @coversDefaultClass \Drupal\Component\Utility\UrlHelper
*/
class UnitTest extends UnitTestCase {

  /**
   * @return array
   */
  public function providerTestValidAbsoluteData() {
    return [
      ['http://example.com'],
      ['https://www.example.com'],
      ['http://ex-ample.com'],
      ['https://3xampl3.com'],
      ['http://example.com:8080'],
      ['https://subdomain.example.com'],
      ['http://example.com/index.php/node?param=false'],
      ['https://user:pass@www.example.com:8080/login.php?do=login&style=%23#pagetop'],
      ['http://127.0.0.1'],
      ['http://john%20doe:secret:foo@example.org/'],
      ['https://[FEDC:BA98:7654:3210:FEDC:BA98:7654:3210]:80/index.html'],
    ];
  }

  /**
   * Tests valid absolute URLs.
   *
   * @dataProvider providerTestValidAbsoluteData
   * @covers ::isValid
   */
  public function testValidAbsoluteUrl($url) {
    $valid_url = UrlHelper::isValid($url, TRUE);
    $this->assertTrue($valid_url, $url . ' is a valid URL.');
  }

  /**
   * @return array
   */
  public function providerTestInValidAbsoluteData() {
    return [
      ['http//example.com'],
      ['https:www.example.com'],
      ['http://[ex-ample.com]'],
      ['https:/3xampl3.com'],
      ['://example.com:8080'],
    ];
  }

  /**
   * Tests valid absolute URLs.
   *
   * @dataProvider providerTestInValidAbsoluteData
   * @covers ::isValid
   */
  public function testInValidAbsolutURL($url){
    $inValid_url = UrlHelper::isValid($url, TRUE);
    $this->assertFalse($inValid_url, $url . ' is not a valid URL.');
  }

}
