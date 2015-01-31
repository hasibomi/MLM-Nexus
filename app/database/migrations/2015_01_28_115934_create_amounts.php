<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmounts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("amounts", function($a)
		{
			$a->increments("id");
			$a->integer("user_id");
			$a->integer("amount");
			$a->boolean('status')->default(0);
			$a->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("amounts");
	}

}
