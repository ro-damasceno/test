<?php
namespace App\Contracts\Repositories\Behaviors;

interface ICreatable {

	/**
	 * Cria um novo item.
	 *
	 * @param array $attributes
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function create(array $attributes);
}