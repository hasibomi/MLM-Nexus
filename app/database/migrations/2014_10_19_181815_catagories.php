<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Catagories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('catagories', function($theCatagory) {
			$theCatagory->increments('id');
			$theCatagory->string('catagory_name')->unique();
			$theCatagory->string('catagory_type');
			$theCatagory->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('catagories');
	}

}
