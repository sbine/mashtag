<?php

use Mashtag\API\StackExchange\Question\StackExchangeQuestionRepository;

class HomeController extends BaseController {

	public function __construct(StackExchangeQuestionRepository $stackExchange) {
		$this->stackExchange = $stackExchange;
	}

	public function index() {
		$stackOverflow = $this->stackExchange->getQuestionsByTag("laravel");
		$this->layout->content = View::make('index')->with('stackoverflow', $stackOverflow);
	}

}