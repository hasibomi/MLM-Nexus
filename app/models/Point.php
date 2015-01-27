<?php

class Point extends Eloquent
{
    protected $fillable = ["user_id", "point"];
    
    public static $rules = ["user_id" => "required | numeric", "point" => "required | numeric"];
    
    public function user()
    {
        $this->hasMany("User", "id", "user_id");
    }
}
