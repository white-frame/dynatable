<?php namespace Ifnot\Dynatable;

/**
 * Class Dynatable
 */
class Dynatable {
	protected $query;
	protected $options;
	protected $columns;
	protected $rows;

	/**
	 * @param $query
	 */
	public function __construct($query, $options)
	{
		$this->query = $query;
		$this->options = $options;
	}

	/**
	 * @param $name
	 * @param $handler
	 */
	public function addColumn($name, $handler)
	{
		$this->columns[$name] = $handler;
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->query;
	}
}