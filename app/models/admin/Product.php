<?php

class Product extends Eloquent
{
	protected $fillable = array(
		'id', 'catagory', 'name', 'price', 'description', 'condition', 'brand', 'image', 'quantity', 'point', 'code', 'create_at', 'updated_at'
	);
	
	protected $table = 'products';
}
