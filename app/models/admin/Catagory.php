<?php

class Catagory extends Eloquent
{
	protected $fillable = array('id', 'catagory_type', 'catagory_name');

	 public function carts()
	 {
	 	return $this->hasMany('Cart', 'catagory_id', 'id');
	 }

    public function subcatagories()
    {
        return $this->hasMany("Subcatagory", "catagory_id", "id");
    }

    public function products()
    {
        return $this->hasMany("Product", "catagory_id", "id");
    }
}
