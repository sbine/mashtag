<?php namespace Mashtag\API\GooglePlus\Activity;

use Mashtag\API\GooglePlus\GooglePlusApiConnector;

class GooglePlusActivityRepository extends GooglePlusApiConnector {

	public function __construct() {
		parent::__construct();
	}


	/**
	 * Get a set of activities for a given tag
	 * @param string $tag 
	 * @return json
	 */

	public function getActivitiesByTag($tag) {
		// @TODO: add key
		$response = $this->doRequest("get", "activities?query=$tag&key=" . $this->getKey());
		return $response;
	}

}