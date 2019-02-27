<?php
namespace App\Repositories\Behaviors\Delete;

use App\Contracts\Repositories\IRepository;

abstract class BaseDeleteBehavior {

	/**
	 * @var IRepository $repository
	 */
	protected $repository;

	/**
	 * CreateBehavior constructor.
	 *
	 * @param IRepository $repository
	 */
	public function __construct (IRepository $repository) {
		$this->repository  = $repository;
	}

	/**
	 * Delete o item com o id fornecido.
	 *
	 * @param int $id
	 * @return bool
	 * @throws \Exception
	 * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
	 */
	public function delete($id) {
		return $this->repository->getQueryBuilder()->findOrFail ($id)->delete();
	}
}