<?php namespace Mashtag\API\StackExchange;

use \Guzzle\Http\Client as Client;

abstract class StackExchangeApiConnector {

	protected static $baseUrl = "http://api.stackexchange.com";
	protected static $apiVersion = "2.2";

	public function __construct() {

	}

	public function doRequest($method, $queryString) {
		$url = self::$baseUrl . "/" . self::$apiVersion . "/" . $queryString;
		$client = new Client($url);

		$response = $client->$method()->send();
		
		# Decompress gzip response
		return gzinflate(substr($response->getBody(true), 10, -8));
	}

}