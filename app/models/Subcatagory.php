<?php
class Subcatagory extends Eloquent
{
    protected $fillable = ["subcatagory_name", "catagory_id"];

    public function catagories()
    {
        return $this->belongsTo("Catagory", "catagory_id", "id");
    }
}