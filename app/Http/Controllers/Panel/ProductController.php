<?php

namespace App\Http\Controllers\Panel;

use App\ProductModel;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Redirect;

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
	 * Retorna a view com a lista de produtos.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index () {

		$queries  = $this->getQueries ();
		$products = $this->repository->find ($queries, $this->getPaginateOption(true));

		return view ('/panel/product/index', [
			'products' => $products,
			'queries'  => $queries,
		]);
	}

	/**
	 * @param $id
	 * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function show ($id) {

		try {
			$product = $this->repository->findOrFail ($id);

			return view ('/panel/product/edit', [
				'product' => $product,
			]);

		} catch (\Exception $error) {
			return Redirect::to('/panel/products')->with('error', 'Product not found');
		}
	}

	public function create () {
		return view ('/panel/product/edit', [
			'product' => new ProductModel()
		]);
	}

	public function store () {
		try {
			$product = $this->repository->create (request ()->all ());
			return response ()->json (['product' => $product], 200);

		} catch (\Illuminate\Validation\ValidationException $error) {
			return response ()->json ([
				'type'	=> 'validation',
				'error' => $error->getMessage (),
				'items' => $error->errors ()
			], 400);

		} catch (\Exception $error) {
			return response ()->json (['error' => $error->getMessage ()], 400);
		}
	}

	public function update ($id) {
		try {
			$product = $this->repository->update ($id, request ()->all ());
			return response ()->json (['product' => $product], 200);

		} catch (\Illuminate\Validation\ValidationException $error) {
			return response ()->json ([
				'type'	=> 'validation',
				'error' => $error->getMessage (),
				'items' => $error->errors ()
			], 400);

		} catch (\Exception $error) {
			return response ()->json (['error' => $error->getMessage ()], 400);
		}
	}

	public function destroy ($id) {
		try {
			$this->repository->delete ($id);
			return response ()->json (null, 201);

		} catch (\Exception $error) {
			return response ()->json (['error' => $error->getMessage ()], 400);
		}
	}

	function fakeItems () {
		try {
			factory (ProductModel::class, 50)->create ();
			return response ()->json (null, 201);

		} catch (\Exception $error) {
			return response ()->json (['error' => $error->getMessage ()], 400);
		}
	}
}