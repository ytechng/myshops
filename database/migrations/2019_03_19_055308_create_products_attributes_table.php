<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsAttributesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('products_attributes', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id');
			$table->integer('merchant_id');
			$table->string('product_sku');
			$table->string('product_color');
			$table->string('size');
			$table->string('weight');
			$table->float('price');
			$table->integer('stock');
			$table->tinyInteger('status');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('products_attributes');
	}
}
