<?php

class Amount extends Eloquent
{
    protected $fillable = ['user_id', 'amount', 'status'];

    public function user()
    {
        return $this->belongsTo("User", 'user_id', 'id');
    }
}