<?php
namespace App\Repositories\Concerns;

use App\Repositories\Behaviors\Delete\BaseDeleteBehavior;

trait HasDeleter {

	/**
	 * @var BaseDeleteBehavior $deleter
	 */
	protected $deleter;

	/**
	 * @return BaseDeleteBehavior
	 */
	function getDeleter () {
		return $this->deleter;
	}
}