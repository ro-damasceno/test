<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;

abstract class BaseController extends Controller {

	/**
	 * @var \App\UserModel $_user
	 */
	protected $_user;

	/**
	 * AbstractController constructor.
	 *
	 */
	public function __construct () {

		$this->middleware(function ($request, $next) {
			if (app ()->has ('user')) {
				$this->_user = app ()->get ('user');
			}
			return $next($request);
		});
	}
}
