<?php namespace Mashtag\API\GitHub;

use \Guzzle\Http\Client as Client;

abstract class GitHubApiConnector {

	protected static $baseUrl = "https://api.github.com";

	public function __construct() {

	}

	/**
	 * Perform an API request
	 * @param string $method 
	 * @param string $queryString 
	 * @return json
	 */

	public function doRequest($method, $queryString) {
		$url = self::$baseUrl . "/" . $queryString;
		$client = new Client($url);

		$response = $client->$method()->send();

		# Return response
		return $response->getBody(true);
	}

}
