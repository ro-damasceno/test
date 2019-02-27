<?php
namespace App\Repositories\Behaviors\Create;

use App\Contracts\Repositories\IRepository;

abstract class BaseCreateBehavior {

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
	 * Cria um novo item.
	 *
	 * @param array $attributes
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function create(array $attributes) {
		return $this->repository->getQueryBuilder()
			->create ($this->repository->withCreateAttributes ($attributes));
	}
}