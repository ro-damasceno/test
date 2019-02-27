<?php
namespace App\Repositories\Concerns;

use Illuminate\Support\Facades\Hash;

trait HasEncryptPassword {

	/**
	 * @return string
	 */
	function getPasswordName() {
		return 'password';
	}

	/**
	 * @param array $attributes
	 * @return void
	 */
	function encryptPassword (array &$attributes) {
		$key = $this->getPasswordName ();
		if ($key && isset($attributes[$key])) {
			$attributes[$key] = Hash::make ($attributes[$key]);
		}
	}
}