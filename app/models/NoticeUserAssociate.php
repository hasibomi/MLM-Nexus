<?php
class NoticeUserAssociate extends Eloquent
{
	protected $fillable = ["notice_id", "user_id"];

	public static $rules = ["notice_id" => "required | number", "user_id" => "required | number"];
}