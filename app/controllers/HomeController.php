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

		$this->layout->content = View::make('index')
									->with('stackoverflow', $stackOverflow)
									->with('googleplus', $googlePlus)
									->with('github', $gitHub);


	}

}