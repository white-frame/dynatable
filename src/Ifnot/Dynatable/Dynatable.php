<?php namespace Ifnot\Dynatable;

use Ifnot\Dynatable\Table\Row;
use Ifnot\Dynatable\Table\RowCollection;

/**
 * Class Dynatable
 */
class Dynatable {
	protected $query;
	protected $options;

	protected $columns;
	protected $search;

	/**
	 * @param $query
	 */
	public function __construct($query, $columns = [], $inputs)
	{
		$this->query = $query;

		// Define initial columns by params
		foreach($columns as $name) {
			$this->columns[$name] = function($row) use ($name) {
				return $row->$name;
			};
		}

		// Define default search engine
		$this->search = function($query, $term) {
			foreach($this->columns as $name => $handler) {
				$query->orWhere($name, 'LIKE', '%' . $this->options['search'] . '%');
			}

			return $query;
		};

		$this->options = [
			'page-length' => (int) $inputs['perPage'],
			'page-number' => (int) $inputs['page'],
			'offset' => (int) $inputs['offset'],
			'sorts' => isset($inputs['sorts']) ? $inputs['sorts'] : null,
			'search' => isset($inputs['search']) ? $inputs['search'] : null,
		];
	}

	/**
	 * Define the display handler for the defined column
	 *
	 * @param $name
	 * @param $handler
	 *
	 * @return $this
	 */
	public function column($name, $handler)
	{
		$this->columns[$name] = $handler;

		return $this;
	}

	/**
	 * Define the search handler for the table
	 *
	 * @param $handler
	 */
	public function search($handler)
	{
		$this->search = $handler;
	}

	/**
	 * @return bool
	 */
	public function handleSearch()
	{
		if(!isset($this->options['search']))
			return false;

		$handler = $this->search;

		$this->query = $handler($this->query, $this->options['search']);
	}

	/**
	 *
	 */
	public function handleSorting()
	{
		if(!isset($this->options['sorts']))
			return false;

		foreach($this->options['sorts'] as $name => $mode) {
			$this->query->orderBy($name, $mode == 1 ? 'asc' : 'desc');
		}
	}

	/**
	 *
	 */
	public function handlePagination()
	{
		$this->query->skip($this->options['offset'])->take($this->options['page-length']);
	}

	/**
	 * Passing Fluent records into the column handler for making the real record list
	 *
	 * @return array
	 */
	protected function getRecords()
	{
		$records = [];

		foreach($this->query->get() as $row) {
			$record = [];
			foreach($this->columns as $name => $handler) {
				$record[$name] = $handler($row);
			}
			$records[] = $record;
		}

		return $records;
	}

	/**
	 * @return string
	 */
	public function make()
	{
		$datas = [];

		// Apply the search filter
		$this->handleSearch();

		$datas['totalRecordCount'] = $this->query->get()->count();
		$datas['queryRecordCount'] = $this->query->get()->count();

		// Filter items by pagination
		$this->handleSorting();
		$this->handlePagination();

		$datas['records'] = $this->getRecords();

		return $datas;
	}
}