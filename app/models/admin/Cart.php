<?php

class Cart extends Eloquent
{
	protected $fillable = array(
		'invoice_no', 'member_id', 'product_catagory', 'product_name', 'product_brand', 'product_price', 'quantity', 'point'
	);
}
