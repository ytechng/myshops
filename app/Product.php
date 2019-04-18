<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
	
	// linking with product attributes
	public function attributes() {
		return $this->hasMany('App\ProductsAttribute', 'product_id');
	}

	// linking with product images
	public function images() {
		return $this->hasMany('App\ProductsImage', 'product_id');
	}

}
