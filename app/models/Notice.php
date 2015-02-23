<?php
class Notice extends Eloquent
{
	protected $fillable = ["associated_users", "body"];
	
	public static $rules = ["body" => "required | min:5"];

    public function users()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }
}