<?php
namespace App\Repositories\Concerns;

use App\Repositories\Behaviors\Create\BaseCreateBehavior;

trait HasCreator {

	/**
	 * @var BaseCreateBehavior $creator
	 */
	protected $creator;

	/**
	 * @return BaseCreateBehavior
	 */
	function getCreator () {
		return $this->creator;
	}

	function withCreateAttributes (array $attributes) {
		return $attributes;
	}
}