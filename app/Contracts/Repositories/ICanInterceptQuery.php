<?php
namespace App\Contracts\Repositories;

interface ICanInterceptQuery {

	/**
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param array $queries
	 * @return void
	 */
	function withSelectManyQuery($query, $queries): void;

	/**
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param array $options
	 * @return void
	 */
	function withSelectOneQuery($query, $options): void;
}