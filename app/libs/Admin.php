<?php

class Admin
{
	public static function isAdmin()
	{
		if(Auth::user() && Auth::user()->type == "admin")
		{
			return Auth::user()->type;
		}
	}
}
