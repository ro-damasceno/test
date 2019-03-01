<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Panel\BaseController;
use App\ProductModel;
use App\Repositories\ProductRepository;

class ProductController extends BaseController {

	/**
	 * @var ProductRepository $repository
	 */
	protected $repository;

	/**
	 * ProductController constructor.
	 *
	 * @param ProductRepository $repository
	 */
	function __construct (ProductRepository $repository) {
		parent::__construct ();
		$this->repository = $repository;
	}

	/**
	 * Retorna uma lista de produtos.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index () {
		$paginated = $this->getPaginateOption(true);
		$products = $this->repository->find ($this->getQueries (), $paginated);
		return response ()->json ($paginated?$products:['data'=>$products]);
	}

	/**
	 * @param $id
	 * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function show ($id) {

		try {
			$product = $this->repository->findOrFail ($id);
			return response ()->json (['data' => $product]);

		} catch (\Illuminate\Database\Eloquent\ModelNotFoundException $error) {
			return response ()->json (['error' => 'Product not found'], 404);

		} catch (\Exception $error) {
			return response ()->json (['error' => $error->getMessage ()], 400);
		}
	}

	public function store () {
		try {
			$product = $this->repository->create (request ()->all ());
			return response ()->json (['product' => $product], 200);

		} catch (\Illuminate\Validation\ValidationException $error) {
			return response ()->json ([
				'error'    => $error->getMessage (),
				'messages' => $error->errors ()
			], 400);

		} catch (\Exception $error) {
			return response ()->json (['error' => $error->getMessage ()], 400);
		}
	}

	public function update ($id) {
		try {
			$product = $this->repository->update ($id, request ()->all ());
			return response ()->json (['data' => $product], 200);

		} catch (\Illuminate\Validation\ValidationException $error) {
			return response ()->json ([
				'error'    => $error->getMessage (),
				'messages' => $error->errors ()
			], 400);

		} catch (\Exception $error) {
			return response ()->json (['error' => $error->getMessage ()], 400);
		}
	}

	public function destroy ($id) {
		try {
			$this->repository->delete ($id);
			return response ()->json (null, 204);

		} catch (\Exception $error) {
			return response ()->json (['error' => $error->getMessage ()], 400);
		}
	}

	function makeFakeItems () {
		try {
			factory (ProductModel::class, 50)->create ();
			return response ()->json (null, 201);

		} catch (\Illuminate\Database\Eloquent\ModelNotFoundException $error) {
			return response ()->json (['error' => 'Product not found'], 404);

		} catch (\Exception $error) {
			return response ()->json (['error' => $error->getMessage ()], 400);
		}
	}
}