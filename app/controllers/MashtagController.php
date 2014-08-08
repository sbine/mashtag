<?php

use Mashtag\API\StackExchange\StackExchangeConnector;
use Mashtag\API\GooglePlus\GooglePlusConnector;
use Mashtag\API\GitHub\GitHubConnector;

class MashtagController extends BaseController {

	public function __construct(StackExchangeConnector $stackExchange, GooglePlusConnector $googlePlus, GitHubConnector $gitHub) {
		$this->stackExchange = $stackExchange;
		$this->googlePlus = $googlePlus;
		$this->gitHub = $gitHub;
	}

	public function get_results() {
		$tag = Input::get("tag", "laravel");

		$stackOverflow = $this->stackExchange->getActivityForTag($tag);
		$googlePlus = $this->googlePlus->getActivityForTag($tag);
		$gitHub = $this->gitHub->getActivityForTag($tag);

		$tagResults = array_merge($stackOverflow, $googlePlus);
		$tagResults = array_merge($tagResults, $gitHub);

		usort($tagResults, function($a, $b) {
			return $a['date'] < $b['date'];
		});

		$results = array(
			'tag' => $tag,
			'results' => $tagResults
		);

		return Response::json($results);

	}

}