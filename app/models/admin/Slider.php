<?php

class Slider extends Eloquent
{
    protected $fillable = array('slider_id', 'slider_text', 'slider1', 'slider2', 'slider3', 'slider4', 'slider5', 'slider6', 'active');
    
    protected $table = 'sliders';
}