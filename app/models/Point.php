<?php

class Point extends Eloquent
{
    protected $fillable = ["user_id", "point"];
    
    public static $rules = ["user_id" => "required | numeric", "point" => "required | numeric"];
    
    public function user()
    {
        return $this->belongsTo("User", "user_id", "id");
    }

    public function product()
    {
        return $this->belongsTo("Product", "product_id", "id");
    }
}
