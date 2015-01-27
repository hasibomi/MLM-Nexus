<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($theUser)
		{
			$theUser->increments('id');
			$theUser->string('name');
			$theUser->string('email');
			$theUser->string('password');
			$theUser->string('gender', 7);
			$theUser->integer('date_of_birth');
			$theUser->integer('month_of_birth');
			$theUser->integer('year_of_birth');
			$theUser->string('profile_picture');
      $theUser->text('permanent_address');
			$theUser->text('present_address');
			$theUser->string('designation', 100);
			$theUser->string('type', 7);
			$theUser->integer('referal_id');
			$theUser->integer('token');
			$theUser->integer('active');
			$theUser->string('arrange_group', 12);
			$theUser->string('remember_token', 100);
			$theUser->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
