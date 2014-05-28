<?php namespace Mashtag\API;

interface ApiConnectorInterface {

	public function doRequest($method, $queryString);
	
	public function getActivityForTag($tag);

}