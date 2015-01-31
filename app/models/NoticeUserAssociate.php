<?php
class NoticeUserAssociate extends Eloquent
{
	protected $fillable = ["notice_id", "user_id"];

	public static $rules = ["notice_id" => "required | number", "user_id" => "required | number"];

	public function user()
	{
		return $this->belongsTo("User", "user_id", "id");
	}

	public function notice()
	{
		return $this->belongsTo("Notice", "notice_id", "notice_id");
	}
}