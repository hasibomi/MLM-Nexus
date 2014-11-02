<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Carts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('carts', function($cart)
		{
			$cart->increments('id');
			$cart->string('invoice_no')->unique();
			$cart->integer('member_id');
			$cart->string('product_catagory');
			$cart->string('product_name');
			$cart->string('product_brand');
			$cart->int('quantity');
			$cart->string('product_price');
			$cart->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('carts');
	}

}
