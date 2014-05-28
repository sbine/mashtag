<?php

use Mashtag\API\StackExchange\StackExchangeConnector;
use Mashtag\API\GooglePlus\GooglePlusConnector;
use Mashtag\API\GitHub\GitHubConnector;

class HomeController extends BaseController {

	public function __construct(StackExchangeConnector $stackExchange, GooglePlusConnector $googlePlus, GitHubConnector $gitHub) {
		$this->stackExchange = $stackExchange;
		$this->googlePlus = $googlePlus;
		$this->gitHub = $gitHub;
	}

	public function index() {
		$tag = "laravel";

		$stackOverflow = $this->stackExchange->getActivityForTag($tag);
		$googlePlus = $this->googlePlus->getActivityForTag($tag);
		$gitHub = $this->gitHub->getActivityForTag($tag);

		$tagResults = array_merge($stackOverflow, $googlePlus);
		$tagResults = array_merge($tagResults, $gitHub);

		usort($tagResults, function($a, $b) {
			return $a['date'] < $b['date'];
		});

		$this->layout->content = View::make('index')
									->with('tag', $tag)
									->with('tagResults', $tagResults);


	}

}