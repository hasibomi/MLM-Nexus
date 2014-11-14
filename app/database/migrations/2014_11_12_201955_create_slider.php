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
           $slider->string('slider1');
           $slider->string('slider2');
           $slider->string('slider3');
           $slider->string('slider4');
           $slider->string('slider5');
           $slider->string('slider6');
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
