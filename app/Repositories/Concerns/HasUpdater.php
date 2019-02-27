<?php
namespace App\Repositories\Concerns;

use App\Repositories\Behaviors\Update\BaseUpdateBehavior;

trait HasUpdater {

	/**
	 * @var BaseUpdateBehavior $updater
	 */
	protected $updater;

	/**
	 * @return BaseUpdateBehavior
	 */
	function getUpdater () {
		return $this->updater;
	}

	function withUpdateAttributes (array $attributes) {
		return $attributes;
	}
}