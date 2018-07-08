<?php

namespace App\Traits;
//use GuzzleHttp\Client;

use Request;
use Config;
/*
use App\Traits\GuzzleTrait;

*/
trait GuzzleTrait {

  public function __construct()
  {
/*
    $this->client  =     new Client(['timeout'  => 2.0]);
private $client;


if (!isset(self::$client)) {
public static $client = 12;
self::$client = new Client([
'base_uri' => 'http://httpbin.org',
'timeout'  => 2.0,
]);
}
*/
}
/*
public function firstData()
{

  $apikey='a6c8b44f5a324957992a1bf53980f885';
  $apisecret='bda4cd1188414a549546ee451358a8a5';
  $nonce=time();
//$getUrl = $_GET['url'];
  $getUrl='https://bittrex.com/api/v1.1/account/getbalances?apikey='.$apikey.'&nonce='.$nonce;
  $uri= $getUrl . '?apikey='.$apikey.'&nonce='.$nonce;
//."&market=ETH-LTC";
  $client = new Client();
  $sign=hash_hmac('sha512',$uri,$apisecret);
  $response = $client->request('GET', $uri, [
    'headers' => [
      'apisign' => $sign
    ],
    'verify' => false]);
  return response()->json(json_decode($response->getBody()), 200);


}
*/
}
