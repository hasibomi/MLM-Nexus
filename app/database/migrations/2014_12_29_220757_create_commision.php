<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommision extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("commisions", function($table) {
            $table->increments("id");
            $table->integer("user_id");
            $table->integer("referal_id");
            $table->integer("user_ammount");
            $table->integer("referal_ammount");
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("commisions");
	}

}
