<?php

class Social
{

	public static function facebook($facebook)
	{
		if ($facebook != "")
		{
			return $facebook;
		}
	}

	public static function twitter($twitter)
	{
		if ($twitter != "")
		{
			return $twitter;
		}
	}

	public static function google($google)
	{
		if ($google != "")
		{
			return $google;
		}
	}

	public static function status($status)
	{
		if ($status == 1)
		{
			return '<font color="#769e77"><span class="glyphicon glyphicon-ok"></span></font>';
		}
		else if ($status == 0)
		{
			return '<font color="#a94442"><span class="glyphicon glyphicon-remove"></span></font>';
		}
	}
}