<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContent extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create table content
        Schema::create( 'contents', function($row) {
            $row->increments( 'id' );
            $row->string('title');
            $row->text('description');
            $row->string('call_name');
            $row->boolean("active")->default(1);
            $row->timestamps();
        } );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete table content
        Schema::drop('contents');
	}

}
