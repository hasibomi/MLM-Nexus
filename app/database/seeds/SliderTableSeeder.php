<?php

class SliderTableSeeder extends Seeder
{
	public function run()
	{
		$s = new Slider;

		$s->slider_id = 0;
		$s->active = 1;

		$s->save();
	}
}