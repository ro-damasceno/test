<?php
namespace App\Contracts\Repositories\Behaviors;

interface IDeletable {

	/**
	 * Delete o item com o id fornecido.
	 *
	 * @param int $id
	 * @return bool
	 * @throws \Exception
	 * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
	 */
	public function delete($id);
}