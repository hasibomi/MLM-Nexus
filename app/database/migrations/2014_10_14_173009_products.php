<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function($theProduct) {
			$theProduct->increments('id');
			$theProduct->string('catagory');
			$theProduct->string('name');
			$theProduct->integer('price');
            $theProduct->string('condition');
            $theProduct->string('brand');
			$theProduct->text('description');
			$theProduct->string('image');
			$theProduct->integer('point');
			$theProduct->string('code');
			$theProduct->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
