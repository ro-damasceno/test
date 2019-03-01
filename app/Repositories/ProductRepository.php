<?php
namespace App\Repositories;

use App\ProductModel;
use Illuminate\Validation\Rule;

class ProductRepository extends BaseRepository {

	public function __construct () {
		parent::__construct ();
		$this->getReader ()
			->setFindableAttributes ('name', 'sku')
			->setSortableAttributes ('name', 'sku', 'price');
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getResourceModel () {
		return ProductModel::class;
	}

	/**
	 * {@inheritdoc}
	 */
	function rules ($model = null) {
		$rules = [
			'sku'  	      => [
				'required',
				'max:50',
				tap (Rule::unique ('products'), function($rule) use ($model){
					if ($model && $model->exists) {
						$rule->ignore ($model->getKey());
					}
				})
			],
			'name' 		  => 'required|min:3|max:200',
			'description' => 'required',
			'price' 	  => 'required|numeric',
		];

		return $rules;
	}
}