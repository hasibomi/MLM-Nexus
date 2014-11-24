<?php

class ContactInfo extends Eloquent
{

	protected $fillable = array('description', 'facebook', 'twitter', 'google', 'status');

	public static $rules = array('description'=>'required|min:10', 'facebook'=>'min:15', 'twitter'=>'min:15', 'google'=>'min:15');
}