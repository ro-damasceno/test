<?php
namespace App\Contracts\Repositories\Behaviors;

interface IUpdatable {

	/**
	 * Atualiza o item com o id fornecido.
	 *
	 * @param string | int $id
	 * @param array $attributes
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function update($id, array $attributes);
}