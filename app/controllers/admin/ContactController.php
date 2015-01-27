<?php

class ContactController extends BaseController
{

	public function __construct()
	{
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('admin');
	}

	// List page
	public function getIndex()
	{
		return View::make('Dashboard.ContentManagement.Contacts.All')
			->with('info', ContactInfo::all());
		
	}

	// Add contact info
	public function getAdd()
	{
		return View::make('Dashboard.ContentManagement.Contacts.Add');
	}

	// Add info
	public function postCreate()
	{
		$validator = Validator::make(Input::all(), ContactInfo::$rules);

		if ($validator->passes())
		{
			$info = new ContactInfo;

			$info->description 	= Input::get('description');
			$info->facebook		= Input::get('facebook');
			$info->twitter		= Input::get('twitter');
			$info->google 		= Input::get('google');

			if (count(ContactInfo::all()) >= 1)
			{
				$info->status 	= 0;
			}
			else
			{
				$info->status 	= 1;
			}

			if ($info->save())
			{
				return Redirect::to('dashboard/contact-info')
					->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Contact Info added successfully</p>');
			}
			else
			{
				return Redirect::back()
					->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try again</p>');
			}
		}

		return Redirect::back()
			->withErrors($validator)
			->withInput();
	}

	// Change status
	public function postChange()
	{
		if ( Input::get('status') == "" || Input::get('id') == "")
		{
			return Redirect::to('dashboard/contact-info')->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> Do not remove entries</p>');
		}

		$info = ContactInfo::find(Input::get('id'));

		$info->status = Input::get('status');

		if ( $info->save() )
		{
			if ( Input::get('status') == 1 )
			{
				return Redirect::back()->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Contact is marked active</p>');
			}
			else if ( Input::get('status') == 0 )
			{
				return Redirect::back()->with('event', '<p class="alert alert-warning"><span class="glyphicon glyphicon-exclamation-sign"></span> Contact is marked inactive</p>');
			}
		}

		return Redirect::back()->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try after sometime</p>');
	}

	// Edit info
	public function getEdit($id)
	{
		return View::make('Dashboard.ContentManagement.Contacts.Edit')->with('info', ContactInfo::find($id));
	}

	// Update Info
	public function postUpdate($id)
	{
		$validator = Validator::make(Input::all(), ContactInfo::$rules);

		if ($validator->passes())
		{
			$info = ContactInfo::find($id);

			$info->description 	= Input::get('description');
			$info->facebook		= Input::get('facebook');
			$info->twitter		= Input::get('twitter');
			$info->google		= Input::get('google');

			if ( $info->save() )
			{
				return Redirect::to('dashboard/contact-info')
					->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Contact info updated successfully</p>');
			}

			return Redirect::back()
				->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try again</p>');
		}

		return Redirect::back()->withErrors($validator)->withInput();
	}

	// Delete contact info
	public function postDelete()
	{
		$info = ContactInfo::find(Input::get('id'));

		if ($info->delete())
		{
			return Redirect::back()
				->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Contact info has been deleted successfully</p>');
		}

		return Redirect::back()
				->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try again</p>');
	}
}