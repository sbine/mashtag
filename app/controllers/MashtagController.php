<?php

use Mashtag\API\StackExchange\StackExchangeConnector;
use Mashtag\API\GooglePlus\GooglePlusConnector;
use Mashtag\API\GitHub\GitHubConnector;

class MashtagController extends BaseController
{

	public function __construct(StackExchangeConnector $stackExchange, GooglePlusConnector $googlePlus, GitHubConnector $gitHub)
	{
		$this->stackExchange = $stackExchange;
		$this->googlePlus = $googlePlus;
		$this->gitHub = $gitHub;
	}

        public function search_results($tag)
	{
                // We can first parse all the necessary APIs.
                // The return data is one concatenated array.
                $tagResults = $this->get_results($tag);

                // Array is ordered into chronological order.
                $sortedResults = $this->sort_results($tagResults);

                // Finally, return happy, parsable data back.
                return $sortedResults;
        }

	public function get_results($tag)
	{
		$stackOverflow = $this->stackExchange->getActivityForTag($tag);
		$googlePlus = $this->googlePlus->getActivityForTag($tag);
		$gitHub = $this->gitHub->getActivityForTag($tag);

		$tagResults = array_merge($stackOverflow, $googlePlus, $gitHub);

		return $tagResults;
	}

	public function sort_results($tagResults)
	{
		usort($tagResults, function($a, $b) {
			return $a['date'] < $b['date'];
		});

		return $tagResults;
	}

	public function convert_results_to_json($tagResults)
	{

		return Response::json($tagResults);

	}

}
