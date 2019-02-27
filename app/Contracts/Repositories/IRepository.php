<?php
namespace App\Contracts\Repositories;

use App\Repositories\Behaviors\Base;

interface IRepository extends
	Behaviors\IReadable,
	Behaviors\ICreatable,
	Behaviors\IUpdatable,
	Behaviors\IDeletable,
	ICanInterceptAttributes,
	ICanInterceptQuery
{

	/**
	 * Retorna a query da model fornecida.
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	function getQueryBuilder();
}