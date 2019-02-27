<?php

namespace App\Repositories\Behaviors\Delete;

class CannotDeleteBehavior extends BaseDeleteBehavior {

	/**
	 * @param int $id
	 * @return bool|void
	 * @throws \Exception
	 */
	public function delete ($id) {
		throw new \Exception('Ação deletar não permitida.');
	}
}