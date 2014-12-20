<?php

class Catagory extends Eloquent
{
	protected $fillable = array('id', 'catagory_type', 'catagory_name');

	 public function cart()
	 {
	 	return $this->belongsTo('Cart');
	 }
}
