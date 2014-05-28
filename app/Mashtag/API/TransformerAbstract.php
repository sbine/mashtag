<?php namespace Mashtag\API;

abstract class TransformerAbstract {

	public abstract function transformItem($item);


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