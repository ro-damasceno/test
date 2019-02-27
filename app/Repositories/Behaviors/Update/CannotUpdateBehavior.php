<?php

namespace App\Repositories\Behaviors\Update;

class CannotUpdateBehavior extends BaseUpdateBehavior {

	/**
	 * @param int|string $id
	 * @param array $attributes
	 * @throws \Exception
	 */
	public function update ($id, array $attributes) {
		throw new \Exception('Ação update não permitida.');
	}
}