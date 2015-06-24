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
	protected $sorts;
	protected $search;

	/**
	 * @param $query
	 */
	public function __construct($query, $columns = [], $inputs)
	{
		$this->query = $query;

		$this->options = [
			'page-length' => (int) $inputs['perPage'],
			'page-number' => (int) $inputs['page'],
			'offset' => (int) $inputs['offset'],
			'sorts' => isset($inputs['sorts']) ? $inputs['sorts'] : null,
			'search' => isset($inputs['queries']['search']) ? $inputs['queries']['search'] : null,
		];

		$this->setDefaultHandlers($columns);
	}

	protected function setDefaultHandlers($columns)
	{
		// Define default handler for rendering content of column
		foreach($columns as $name) {
			$this->columns[$name] = function($row) use ($name) {
				return $row->$name;
			};
		}

		// Define default handler for ordering column
		foreach($columns as $name) {
			$this->sorts[$name] = function($query, $mode) use ($name) {
				return $query->orderBy($name, $mode);
			};
		}

		// Define default handler for global searching
		$this->search = function($query, $term) use ($columns) {
			$query->where(function($query) use ($term, $columns) {
				foreach($columns as $column) {
					$query->orWhere($column, 'LIKE', '%' . $term . '%');
				}
			});

			return $query;
		};
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
	 * Define custom sort handler for the defined column
	 *
	 * @param $name
	 * @param $handler
	 *
	 * @return $this
	 */
	public function sort($name, $handler)
	{
		$this->sorts[$name] = $handler;

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

		return $this;
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
			$this->query = $this->sorts[$name]($this->query, $mode == 1 ? 'asc' : 'desc');
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

		$datas['totalRecordCount'] = $this->query->count();
		$datas['queryRecordCount'] = $this->query->count();

		// Filter items by pagination
		$this->handleSorting();
		$this->handlePagination();

		$datas['records'] = $this->getRecords();

		return $datas;
	}
}
