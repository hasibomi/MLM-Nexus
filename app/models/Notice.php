<?php
class Notice extends Eloquent
{
	protected $fillable = ["associated_users", "body"];
	
	public static $rules = ["body" => "required | min:5"];
}