<?php

class Cart extends Eloquent
{
	protected $fillable = array('invoice', 'product_id', 'user_id', 'quantity', 'catagory');

    public static  $rules = array('id'=>'required', 'quantity'=>'required|min:1', 'price' => 'required');

    public function product()
    {
        return $this->belongsTo('Product', 'product_id', 'id');
    }

    public function catagory()
    {
    	return $this->belongsTo('Catagory', 'catagory_id', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }
}
