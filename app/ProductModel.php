<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'products';

	protected $fillable = [
		'sku', 'name', 'description', 'price', 'image'
	];

	function getFormattedPrice() {

		if ($this->price) {
			return number_format ($this->price, 2, '.', '');
		}

		return null;
	}
}
