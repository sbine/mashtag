<?php namespace Mashtag\API\GooglePlus;

use Mashtag\API\TransformerAbstract;

class GooglePlusTransformer extends TransformerAbstract {


	/**
	 * Transform an item into a standardized data format
	 * @param array $item 
	 * @return array
	 */

	public function transformItem($item) {
		return array(
			"title" => $item['title'],
			"date" => strtotime($item['published']),
			"url" => $item['url'],
			"user" => $item['actor']['displayName'],
			"origin" => "GooglePlus"
		);
	}

}