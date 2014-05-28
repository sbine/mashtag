<?php namespace Mashtag\API\GitHub;

use Mashtag\API\TransformerAbstract;

class GitHubTransformer extends TransformerAbstract {

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

}