<?php namespace Mashtag\API\GitHub\Activity;

use Mashtag\API\GitHub\GitHubApiConnector;

class GitHubActivityRepository extends GitHubApiConnector {

	public function __construct() {
		parent::__construct();
	}


	/**
	 * Get a set of activities for a given tag
	 * @param string $tag 
	 * @return json
	 */

	public function getActivitiesByUser($user) {
		// @TODO: add key
		$response = $this->doRequest("get", "users/" . $user . "/events");
		return $response;
	}

}