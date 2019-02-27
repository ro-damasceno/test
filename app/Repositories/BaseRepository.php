<?php
namespace App\Repositories;

use App\Contracts\Repositories\IRepository;
use App\Repositories\Behaviors;

abstract class BaseRepository implements IRepository {

	use Concerns\HasReader,
		Concerns\HasCreator,
		Concerns\HasUpdater,
		Concerns\HasDeleter,
		Concerns\HasValidation;

	public function __construct () {
		$this->registerReader ();
		$this->registerCreator ();
		$this->registerUpdater ();
		$this->registerDeleter ();
	}

	/**
	 * Retorna a class da model.
	 *
	 * @return string
	 */
	protected abstract function getResourceModel();

	/**
	 * {@inheritdoc}
	 */
	function getQueryBuilder() {
		return with($this->getResourceModel ())::query();
	}

	protected function registerReader() {
		$this->reader = new Behaviors\Read\ReadBehavior($this);
	}

	protected function registerCreator() {
		$this->creator = new Behaviors\Create\CreateBehavior($this);
	}

	protected function registerUpdater() {
		$this->updater = new Behaviors\Update\UpdateBehavior($this);
	}

	protected function registerDeleter() {
		$this->deleter = new Behaviors\Delete\DeleteBehavior($this);
	}

	/**
	 * {@inheritdoc}
	 */
	function find ($queries = null, $paginate = false, $paginationOptions = []) {
		return $this->getReader ()->find ($queries, $paginate, $paginationOptions);
	}

	/**
	 * {@inheritdoc}
	 */
	function findOne ($id, array $options = []) {
		return $this->getReader ()->findOne ($id, $options);
	}

	/**
	 * {@inheritdoc}
	 */
	function findOrFail ($id, array $options = []) {
		return $this->getReader ()->findOrFail ($id, $options);
	}

	/**
	 * {@inheritdoc}
	 */
	public function create (array $attributes) {
		$this->validate ($attributes);
		return $this->getCreator ()->create ($attributes);
	}

	/**
	 * {@inheritdoc}
	 */
	public function update ($id, array $attributes) {
		$this->validate ($attributes, $this->findOne ($id));
		return $this->getUpdater ()->update ($id, $attributes);
	}

	/**
	 * {@inheritdoc}
	 */
	public function delete ($id) {
		return $this->getDeleter ()->delete ($id);
	}
}