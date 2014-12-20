<?php

class Product extends Eloquent
{
	protected $fillable = array(
		'id', 'catagory_id', 'name', 'price', 'description', 'product_condition', 'brand', 'image', 'quantity', 'point', 'code', 'product_code'
	);
	
	protected $table = 'products';

	public function cart()
	{
		return $this->belongsTo('Cart');
	}

	public function catagory()
	{
		return $this->belongsTo('Catagory');
	}
}
