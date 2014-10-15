<?php

use Mashtag\API\StackExchange\StackExchangeConnector;
use Mashtag\API\GooglePlus\GooglePlusConnector;
use Mashtag\API\GitHub\GitHubConnector;

class HomeController extends MashtagController {

	public function index($tag)
	{
		$sortedResults = $this->search_results($tag);

		$this->layout->content = View::make('index')
						->with('tag', $tag)
						->with('tagResults', $sortedResults);
	}

	public function home_angular() {
		return View::make('angular/index');
	}

}
