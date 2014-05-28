<?php namespace Mashtag\API\GooglePlus;

use Mashtag\API\TransformerInterface;

class GooglePlusTransformer implements TransformerInterface {


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