<?php namespace Mashtag\API\GooglePlus;

use \Guzzle\Http\Client as Client;

abstract class GooglePlusApiConnector {

	protected static $baseUrl = "https://www.googleapis.com/plus";
	protected static $apiVersion = "v1";
	protected $key;

	public function __construct() {

	}

	protected function getKey() {
		if (!$this->key) {
			$this->key = getenv('GOOGLE_PLUS_KEY');
		}
		return $this->key;
	}


	/**
	 * Perform an API request
	 * @param string $method 
	 * @param string $queryString 
	 * @return json
	 */

	public function doRequest($method, $queryString) {
		$url = self::$baseUrl . "/" . self::$apiVersion . "/" . $queryString;
		$client = new Client($url);

		$response = $client->$method()->send();

		# Decompress gzip response
		return $response->getBody(true);
	}

}