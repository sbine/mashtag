<?php

use Mashtag\API\StackExchange\Question\StackExchangeQuestionRepository;
use Mashtag\API\GooglePlus\Activity\GooglePlusActivityRepository;

class HomeController extends BaseController {

	public function __construct(StackExchangeQuestionRepository $stackExchange, GooglePlusActivityRepository $googlePlus) {
		$this->stackExchange = $stackExchange;
		$this->googlePlus = $googlePlus;
	}

	public function index() {
		$stackOverflow = $this->stackExchange->getQuestionsByTag("laravel");
		$googlePlus = $this->googlePlus->getActivitiesByTag("laravel");

		$this->layout->content = View::make('index')
									->with('stackoverflow', $stackOverflow)
									->with('googleplus', $googlePlus);
	}

}