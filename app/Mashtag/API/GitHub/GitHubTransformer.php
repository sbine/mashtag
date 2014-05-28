<?php namespace Mashtag\API\GitHub;

use Mashtag\API\TransformerInterface;

class GitHubTransformer implements TransformerInterface {

	/**
	 * Transform an item into a standardized data format
	 * @param array $item 
	 * @return array
	 */

	public function transformItem($item) {
		return array(
			"title" => $item['title'],
			"date" => strtotime($item['created_at']),
			"url" => $item['html_url'],
			"user" => $item['user']['login'],
			"origin" => "GitHub"
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