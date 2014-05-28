<?php namespace Mashtag\API\StackExchange;

use Mashtag\API\ApiConnectorInterface;
use Mashtag\API\StackExchange\StackExchangeTransformer;
use Guzzle\Http\Client;

class StackExchangeConnector implements ApiConnectorInterface {

	protected static $baseUrl = "https://api.stackexchange.com";
	protected static $apiVersion = "2.2";
	protected $key;


	/**
	 * Get API key
	 * @return string
	 */

	protected function getKey() {
		if (!$this->key) {
			$this->key = getenv('STACKEXCHANGE_KEY');
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
		return json_decode(gzinflate(substr($response->getBody(true), 10, -8)), true);
	}


	/**
	 * Get activity for a given tag
	 * @param string $tag 
	 * @return json
	 * 
	 * TODO: care about key
	 */

	public function getActivityForTag($tag) {
		$response = $this->doRequest("get", "questions?order=desc&sort=activity&tagged=$tag&site=stackoverflow");
		
		$transformer = new StackExchangeTransformer;
		$transformedData = $transformer->transformCollection($response["items"]);

		return $transformedData;
	}

}