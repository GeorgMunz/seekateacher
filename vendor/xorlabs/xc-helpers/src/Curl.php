<?php
namespace XORLabs\XC\Helpers;

class Curl {

  /**
  * curl get to url
  */
  public static function get($url, $params = '')
  {
    // Get cURL resource
    $ch = curl_init();

    // Set some options
    curl_setopt_array($ch, array(
      CURLOPT_RETURNTRANSFER 	=> 1,
      CURLOPT_USERAGENT 		=> 'XC cURL Request'
    ));

    if ( ! $params) {
      curl_setopt($ch, CURLOPT_URL, $url);
    }

    if (is_array($params)) {
      curl_setopt($ch, CURLOPT_URL, "{$url}/?" . http_build_query($params));
    }

    if ($params != '' && is_string($params)) {
      curl_setopt($ch, CURLOPT_URL, "{$url}/?{$params}");
    }


    return static::_exec($ch);
  }

  /**
  * curl to url with post data.
  */
  public static function post($url, $post_data = [])
  {
    // Get cURL resource
    $ch = curl_init();

    // Set some options
    curl_setopt_array($ch, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $url,
      CURLOPT_USERAGENT => 'XC cURL Request',
      CURLOPT_POST => 1,
      CURLOPT_POSTFIELDS => $post_data
    ));

    return self::_exec($ch);
  }

  private static function _exec(&$ch)
  {
    $resp = curl_exec($ch);

    if( ! $resp) {
      throw new \Exception('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
    }

    // Close request to clear up some resources
    curl_close($ch);

    return $resp;
  }
}
