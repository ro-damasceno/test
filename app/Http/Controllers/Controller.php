<?php

namespace App\Http\Controllers;

use App\UserModel;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	/**
	 * Retorna as opções de filtro e ordenação.
	 *
	 * @param array $inputs
	 * @param bool $overwrite
	 * @return array
	 */
	protected function getQueries($inputs = [], $overwrite = false) {
		$fields = ['q', 'sort', 'sort_direction', 'columns'];
		if (is_array ($inputs) && count ($inputs)) {
			if ($overwrite) {
				$fields = $inputs;
			} else {
				$fields = array_merge ($fields, $inputs);
			}
		}

		return request ()->only($fields);
	}

	/**
	 * @param bool $default
	 * @return bool
	 */
	protected function getPaginateOption($default = false) {
		$paginate = request ()->input ('paginate', $default);
		return $paginate === true || $paginate === 1 || ( is_string ($paginate) && in_array ($paginate, ['true', '1']));
	}
}
