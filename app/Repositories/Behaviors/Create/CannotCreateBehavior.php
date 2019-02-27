<?php

namespace App\Repositories\Behaviors\Create;

class CannotCreateBehavior extends BaseCreateBehavior {

	/**
	 * @param array $attributes
	 * @return \Illuminate\Database\Eloquent\Model|void
	 * @throws \Exception
	 */
	public function create (array $attributes) {
		throw new \Exception('Ação criar não permitida.');
	}
}