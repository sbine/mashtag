<?php namespace Mashtag\API\StackExchange\Question;

use Mashtag\API\StackExchange\StackExchangeApiConnector;

class StackExchangeQuestionRepository extends StackExchangeApiConnector {

	public function __construct() {
		parent::__construct();
	}


	/**
	 * Get a set of questions for a given tag
	 * @param string $tag 
	 * @return json
	 */

	public function getQuestionsByTag($tag) {
		$response = $this->doRequest("get", "questions?order=desc&sort=activity&tagged=$tag&site=stackoverflow");
		return $response;
	}

}