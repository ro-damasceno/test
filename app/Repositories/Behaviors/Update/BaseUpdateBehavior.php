<?php
namespace App\Repositories\Behaviors\Update;

use App\Contracts\Repositories\IRepository;

abstract class BaseUpdateBehavior {

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
	 * Atualiza o item com o id fornecido.
	 *
	 * @param string | int $id
	 * @param array $attributes
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function update($id, array $attributes) {

		$model = $this->repository->getQueryBuilder()->findOrFail ($id);
		$model->update ($this->repository->withUpdateAttributes ($attributes));

		return $model;
	}
}