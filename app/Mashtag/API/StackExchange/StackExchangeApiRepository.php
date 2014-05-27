<?php namespace Mashtag\API\StackExchange;

// http://api.stackexchange.com/2.2/questions?order=desc&sort=activity&tagged=laravel&site=stackoverflow

class StackExchangeApiRepository extends StackExchangeApiConnector {

	public function __construct() {
		parent::__construct();
	}

	public function getQuestionsByTag($tag) {
		$response = $this->doRequest("get", "questions?order=desc&sort=activity&tagged=$tag&site=stackoverflow");
		return $response;
	}

}