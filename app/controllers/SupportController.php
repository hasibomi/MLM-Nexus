<?php

class SupportController extends BaseController
{
	public function getIndex()
	{
		return View::make("Dashboard.Support.All");
	}
}
