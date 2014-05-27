<?php



class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

	public function __construct(Mashtag\API\StackExchange\StackExchangeApiRepository $stackExchange) {
		$this->stackExchange = $stackExchange;
	}

	public function index() {
		$stackOverflow = $this->stackExchange->getQuestionsByTag("laravel");
		$this->layout->content = View::make('index')->with('stackoverflow', $stackOverflow);
	}

}
