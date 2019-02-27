<?php
namespace App\Repositories\Behaviors\Read\Concerns;

trait HasPagination {

	/**
	 * Retorna as opções de paginação. Sobrescreve os valores padrões pelas opções fornecidas.
	 *
	 * @param array $paginationOptions
	 * @return array
	 */
	function makePaginationOptions ($paginationOptions = []) {

		$paginationOptions = array_merge ([
			'columns'	=> ['*'],
			'pageName'	=> 'page',
			'page'		=> null,
			'per_page'	=> 20,
		], $paginationOptions);

		if (!is_numeric ($paginationOptions['page'])) {
			$paginationOptions['page'] = 0;
		}

		if (is_numeric($paginationOptions['per_page'])) {
			$paginationOptions['per_page'] = (int) $paginationOptions['per_page'];

		} else {
			$paginationOptions['per_page'] = 20;
		}

		if ($paginationOptions['per_page'] < 0) {
			$paginationOptions['per_page'] = 20;
		}
		if ($paginationOptions['per_page'] > 500) {
			$paginationOptions['per_page'] = 500;
		}

		return $paginationOptions;
	}

	/**
	 * @param \Illuminate\Database\Eloquent\Builder $builder
	 * @param array $paginationOptions
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	function paginate($builder, array $paginationOptions = []) {

		$paginationOptions = $this->makePaginationOptions($paginationOptions);

		return $builder->paginate(
			$paginationOptions['per_page'],
			$paginationOptions['columns'],
			$paginationOptions['pageName'],
			$paginationOptions['page']
		);
	}
}