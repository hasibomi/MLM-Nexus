<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCart extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('carts', function($row) {
            $row->increments('id');
            $row->string('invoice');
            $row->integer('user_id');
            $row->integer('product_id');
            $row->string('catagory');
            $row->integer('quantity');
            $row->boolean('checked_out')->default(0);
            $row->boolean('status')->default(0);
            $row->timestamps();
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
