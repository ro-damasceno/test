<?php
namespace App\Repositories\Concerns;

use Illuminate\Support\Facades\Validator;

trait HasValidation {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @param \Illuminate\Database\Eloquent\Model|null $model
	 * @return array
	 */
	protected function rules($model = null) {
		return [];
	}

	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	protected function messages()
	{
		return [];
	}

	/**
	 * Configure the validator instance.
	 *
	 * @param  \Illuminate\Contracts\Validation\Validator $validator
	 * @return void
	 */
	protected function withValidator($validator) {}

	/**
	 * @param array $attributes
	 * @param \Illuminate\Database\Eloquent\Model|null $model
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	protected function validate (array $attributes, $model = null) {

		if ($model) {
			$attributes = $model->fill ($attributes)->getAttributes ();
		}
		$validator = Validator::make($attributes, $this->rules ($model), $this->messages ());

		$this->withValidator ($validator);
		$validator->validate();
	}
}