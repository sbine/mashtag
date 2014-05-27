<?php

use Mashtag\API\StackExchange\Question\StackExchangeQuestionRepository;
use Mashtag\API\GooglePlus\Activity\GooglePlusActivityRepository;
use Mashtag\API\GitHub\Activity\GitHubActivityRepository;

class HomeController extends BaseController {

	public function __construct(StackExchangeQuestionRepository $stackExchange, GooglePlusActivityRepository $googlePlus, GitHubActivityRepository $gitHub) {
		$this->stackExchange = $stackExchange;
		$this->googlePlus = $googlePlus;
		$this->gitHub = $gitHub;
	}

	public function index() {
		$stackOverflow = $this->stackExchange->getQuestionsByTag("laravel");
		$googlePlus = $this->googlePlus->getActivitiesByTag("laravel");
		$gitHub = $this->gitHub->getActivitiesByUser("taylorotwell");

		$this->layout->content = View::make('index')
									->with('stackoverflow', $stackOverflow)
									->with('googleplus', $googlePlus)
									->with('github', $gitHub);


	}

}