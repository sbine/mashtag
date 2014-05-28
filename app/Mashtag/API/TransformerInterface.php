<?php namespace Mashtag\API;

interface TransformerInterface {

	public function transformItem($item);

	public function transformCollection($collection);

}