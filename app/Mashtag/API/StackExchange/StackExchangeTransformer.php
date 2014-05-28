<?php namespace Mashtag\API\StackExchange;

use Mashtag\API\TransformerInterface;

class StackExchangeTransformer implements TransformerInterface {


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

	/**
	 * Transform a collection of items
	 * @param array $collection 
	 * @return array
	 */

	public function transformCollection($collection) {

		if (!is_array($collection)) {
			throw new Exception("Input data must be an array");
		}

		$items = array();

		foreach ($collection as $item) {
			$items[] = $this->transformItem($item);
		}

		return $items;
	}

}