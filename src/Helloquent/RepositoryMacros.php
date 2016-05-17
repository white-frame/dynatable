<?php namespace WhiteFrame\Dynatable\Helloquent;

use Illuminate\Database\Eloquent\Builder;
use WhiteFrame\Dynatable\Dynatable;
use WhiteFrame\Helloquent\Repository;

/**
 * Class RepositoryMacros
 * @package WhiteFrame\Dynatable
 */
class RepositoryMacros extends \WhiteFrame\Helloquent\Repository
{
	public function register()
	{
		$this->registerScopeToDynatable();
	}

	public function registerScopeToDynatable()
	{
		Repository::macro('scopeToDynatable', function(Builder $query, $options = []) {
			$presentColumns = array_keys($this->getModel()->present()->columns());
			$databaseColumns = $this->getModel()->getColumns();

			$dynatable = Dynatable::of($query, $databaseColumns, $options);

			// Passing all columns by presenters
			foreach($presentColumns as $column) {
				$dynatable = $dynatable->column($column, function ($row) use ($column) {
					return $row->present()->$column;
				});
			}

			// Recording sorting scopes if exists
			foreach($presentColumns as $column) {
				$method = 'scopeSort' . ucfirst(camel_case($column));
				if(method_exists($this, $method)) {
					$dynatable = $dynatable->sort($column, function ($query, $mode) use ($method) {
						return $this->$method($query, $mode);
					});
				}
			}

			// Registering search scope if exists
			if(method_exists($this, 'scopeSearch')) {
				$dynatable = $dynatable->search(function ($query, $term) {
					return $this->scopeSearch($query, $term);
				});
			}

			// Registering search columns scope if exists
			$searchColumns = array_keys($this->getModel()->present()->searches());
			foreach($searchColumns as $column) {
				$scopeName = 'scope' . camel_case($column);

				if(method_exists($this, $scopeName)) {
					$dynatable = $dynatable->search($column, function ($query, $term) use ($scopeName) {
						return $this->$scopeName($query, $term);
					});
				}
			}

			return $dynatable;
		});
	}
}