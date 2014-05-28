<?php namespace Mashtag\API\GooglePlus;

use Mashtag\API\ApiConnectorInterface;
use Mashtag\API\GooglePlus\GooglePlusTransformer;
use Guzzle\Http\Client;

class GooglePlusConnector implements ApiConnectorInterface {

	protected static $baseUrl = "https://www.googleapis.com/plus";
	protected static $apiVersion = "v1";
	protected $key;


	/**
	 * Get API key
	 * @return string
	 */

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

		return $response->json();
	}


	/**
	 * Get activity for a given tag
	 * @param string $tag 
	 * @return json
	 */

	public function getActivityForTag($tag) {
		$response = $this->doRequest("get", "activities?query=$tag&key=" . $this->getKey());

		$transformer = new GooglePlusTransformer;
		$transformedData = $transformer->transformCollection($response["items"]);

		return $transformedData;
	}

}