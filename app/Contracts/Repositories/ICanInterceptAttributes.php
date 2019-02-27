<?php
namespace App\Contracts\Repositories;

interface ICanInterceptAttributes {

	/**
	 * Provê uma forma de manipular os atributos antes da atualização.
	 *
	 * @param array $attributes
	 * @return array
	 */
	function withUpdateAttributes(array $attributes);

	/**
	 * Provê uma forma de manipular os atributos antes de criar o item.
	 *
	 * @param array $attributes
	 * @return array
	 */
	function withCreateAttributes(array $attributes);
}