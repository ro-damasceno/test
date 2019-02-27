<?php
namespace App\Repositories\Concerns;

use App\Repositories\Behaviors\Read\BaseReadBehavior;

trait HasReader {

	/**
	 * @var BaseReadBehavior $reader
	 */
	protected $reader;

	/**
	 * @return BaseReadBehavior
	 */
	function getReader () {
		return $this->reader;
	}

	function withSelectManyQuery ($query, $queries): void {}

	function withSelectOneQuery ($query, $options): void {}
}