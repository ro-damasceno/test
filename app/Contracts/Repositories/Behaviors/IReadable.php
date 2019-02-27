<?php
namespace App\Contracts\Repositories\Behaviors;

interface IReadable {

	/**
	 * Retorna uma coleção com os itens encontrados.
	 *
	 * @param array | \Closure $queries
	 * @param boolean $paginate
	 * @param array $paginationOptions
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
	 */
	function find($queries = null, $paginate = false, $paginationOptions = []);

	/**
	 * Retorna o item com o id fornecido ou null se não encontrado.
	 *
	 * @param int|string $id
	 * @param array $options
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	function findOne($id, array $options = []);

	/**
	 * Retorna o item com o id fornecido ou uma exception se não encontrado.
	 *
	 * @param int|string $id
	 * @param array $options
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	function findOrFail($id, array $options = []);
}