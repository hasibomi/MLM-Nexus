<?php

class Cart extends Eloquent
{
	protected $fillable = array('invoice', 'product_id', 'user_id', 'quantity', 'catagory');

    public static  $rules = array('id'=>'required', 'quantity'=>'required|min:1');

    public function product()
    {
        return $this->hasMany('Product', 'id', 'product_id');
    }

    public function catagory()
    {
    	return $this->hasMany('Catagory', 'id', 'catagory');
    }
    
    public function user()
    {
        return $this->hasMany('User', 'id', 'user_id');
    }
}
