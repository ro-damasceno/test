<?php
namespace App\Repositories\Behaviors\Read\Concerns;

trait HasQueries {

	protected $sortableAttributes = [];

	protected $findableAttributes = [];

	protected $selectableColumns = ['*'];

	/**
	 * @return array
	 */
	public function getSortableAttributes (): array {
		return $this->sortableAttributes;
	}

	/**
	 * @param array $sortableAttributes
	 * @return HasQueries
	 */
	public function setSortableAttributes (...$sortableAttributes) {
		$this->sortableAttributes = $sortableAttributes;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getFindableAttributes (): array {
		return $this->findableAttributes;
	}

	/**
	 * @param array $findableAttributes
	 * @return HasQueries
	 */
	public function setFindableAttributes (...$findableAttributes) {
		$this->findableAttributes = $findableAttributes;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getSelectableColumns (): array {
		return $this->selectableColumns;
	}

	/**
	 * @param array $selectColumns
	 * @return HasQueries
	 */
	public function setSelectableColumns (...$selectColumns) {
		$this->selectableColumns = $selectColumns;
		return $this;
	}

	/**
	 * @param \Illuminate\Database\Eloquent\Builder $builder
	 * @param array | \Closure $queries
	 * @return void
	 */
	public function applyQueries($builder, array $queries = []) {

		if (is_callable ($queries)) {
			call_user_func ($queries, [$builder]);

		} else if (is_array($queries)) {
			$this->order($builder, $queries['sort']??null, $queries['sort_direction']??'asc');
			$this->whereLike($builder, $queries['q']??null);
			$this->selectColumns($builder, $queries['columns']??null);
		}
	}

	/**
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param $sort
	 * @param $direction
	 * @return void
	 */
	protected function order($query, $sort, $direction) {
		if ($sort && in_array ($sort, $this->sortableAttributes)) {
			$direction = in_array(strtolower ($direction), ['asc', 'desc']) ? $direction : 'asc';
			$query->orderBy ($sort, $direction);
		}
	}

	/**
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $value
	 * @return void
	 */
	protected function whereLike($query, $value) {
		if (!empty($value)) {
			$query->where (function($builder) use($value) {

				/** @var \Illuminate\Database\Eloquent\Builder  $builder */
				foreach ($this->findableAttributes as $findableAttribute) {
					$builder->where ($findableAttribute, 'LIKE', "%{$value}%", 'or');
				}
			});
		}
	}

	/**
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $columns
	 */
	protected function selectColumns($query, $columns = null) {

		if (is_string ($columns) && !empty($columns)) {

			$columns = array_map (function($column){
				return trim($column);
			}, explode (',', $columns));

			if (!in_array ('*', $this->selectableColumns)) {
				$columns = array_filter ($columns, function($column){
					return in_array ($column, $this->selectableColumns);
				});
			}

			if (!empty($columns)) {
				$query->select ($columns);
			}
		}
	}
}