<?php namespace Mashtag\API\GitHub;

use Mashtag\API\ApiConnectorInterface;
use Mashtag\API\GitHub\GitHubTransformer;
use Guzzle\Http\Client;

class GitHubConnector implements ApiConnectorInterface {

	protected static $baseUrl = "https://api.github.com";
	protected static $apiVersion = "v3";
	protected $key;


	/**
	 * Get API key
	 * @return string
	 */

	protected function getKey() {
		if (!$this->key) {
			$this->key = getenv('GITHUB_KEY');
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
		$url = self::$baseUrl . "/" . $queryString;
		$client = new Client($url);

		$client->setDefaultOption('headers/Accept', 'application/vnd.github.' . self::$apiVersion . '+json');

		$response = $client->$method()->send();

		return $response->json();
	}


	/**
	 * Get activity for a given tag
	 * @param string $tag 
	 * @return json
	 * 
	 * TODO: care about API key
	 */

	public function getActivityForTag($tag) {
		$response = $this->doRequest("get", "search/issues?q=" . $tag);

		$transformer = new GitHubTransformer;
		$transformedData = $transformer->transformCollection($response["items"]);

		return $transformedData;
	}

}