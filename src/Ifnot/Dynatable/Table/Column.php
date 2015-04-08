<?php namespace Ifnot\Dynatable\Table;

/**
 * Class Column
 * @package Ifnot\Dynatable\Table
 */
class Column {
	protected $name;
	protected $handler;

	/**
	 * @param $name
	 * @param $handler
	 */
	public function __construct($name, $handler)
	{
		$this->name = $name;
		$this->handler = $handler;
	}
}