<?php
namespace App\Repositories\Behaviors\Read;

use App\Contracts\Repositories\IRepository;

abstract class BaseReadBehavior {

	use Concerns\HasPagination;
	use Concerns\HasQueries;

	/**
	 * @var IRepository $repository
	*/
	protected $repository;

	/**
	 * ReadBehavior constructor.
	 *
	 * @param IRepository $repository
	 */
	public function __construct ($repository) {
		$this->repository = $repository;
	}

	/**
	 * Retorna uma coleção com os itens encontrados.
	 *
	 * @param array | \Closure $queries
	 * @param boolean $paginate
	 * @param array $paginationOptions
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
	 */
	function find($queries = null, $paginate = false, $paginationOptions = []) {

		$query = $this->repository->getQueryBuilder();
		$this->applyQueries ($query, $queries);

		$this->repository->withSelectManyQuery($query, is_array($queries) ? $queries : []);

		if ($paginate) {
			return $this->paginate ($query, $paginationOptions);
		}

		return $query->get ();
	}

	/**
	 * Retorna o item com o id fornecido ou null se não encontrado.
	 *
	 * @param int|string $id
	 * @param array $options
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	function findOne($id, array $options = []) {

		$query = $this->repository->getQueryBuilder ();

		$this->repository->withSelectOneQuery($query, $options);

		return $query->find ($id);
	}

	/**
	 * Retorna o item com o id fornecido ou uma exception se não encontrado.
	 *
	 * @param int|string $id
	 * @param array $options
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	function findOrFail($id, array $options = []) {

		$query = $this->repository->getQueryBuilder ();

		$this->repository->withSelectOneQuery($query, $options);

		return $query->findOrFail ($id);
	}
}