<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubcatagories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create("subcatagories", function($c)
        {
            $c->increments("id");
            $c->string("subcatagory_name");
            $c->string("slug");
            $c->integer("catagory_id");
            $c->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop("subcatagories");
	}

}
