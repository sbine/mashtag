<?php namespace Mashtag\API\StackExchange;

use Mashtag\API\TransformerAbstract;

class StackExchangeTransformer extends TransformerAbstract {


	/**
	 * Transform an item into a standardized data format
	 * @param array $item 
	 * @return array
	 */

	public function transformItem($item) {
		return array(
			"title" => $item['title'],
			"date" => $item['creation_date'],
			"url" => $item['link'],
			"user" => $item['owner']['display_name'],
			"origin" => "StackExchange"
		);
	}

}