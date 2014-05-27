<?php namespace Mashtag\API\GitHub;

use \Guzzle\Http\Client as Client;

abstract class GooglePlusApiConnector {

	protected static $baseUrl = "https://api.github.com";
	protected static $apiVersion = "v3";
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

<?php namespace Mashtag\API\StackExchange;

use \Guzzle\Http\Client as Client;

abstract class StackExchangeApiConnector {

	protected static $baseUrl = "https://api.stackexchange.com";
	protected static $apiVersion = "2.2";

	public function __construct() {

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
		return gzinflate(substr($response->getBody(true), 10, -8));
	}

}