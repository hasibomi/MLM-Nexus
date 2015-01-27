<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlider extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create table sliders
        Schema::create('sliders', function($slider)
       {
           $slider->increments('id');
           $slider->integer('slider_id');
           $slider->string('slider_text');
           $slider->string('slider');
           $slider->integer('active');
           $slider->timestamps();
       });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete table sliders
        Schema::drop('sliders');
	}

}
