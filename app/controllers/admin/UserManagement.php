<?php

class UserManagement extends BaseController
{
	// User management page
	public function userManagementPage()
	{
		$user = User::where( 'id', '!=', Auth::id() );
		
		return View::make('Dashboard.UserManagement.All', array('users' => $user));
	}
	
	// View user
	public function viewUser($slug)
	{
		$user = User::where( 'slug', '=', $slug )->orWhere('id', $slug)->get();
		
		return View::make( 'Dashboard.UserManagement.Edit', array( 'user' => $user ) );
	}
	
	// Activate user
	public function activeUser($slug)
	{
		$query = User::where( "slug", $slug );
		
		if($query->count() > 0)
		{
            $activate = $query->update(['active' => 1]);

			if ( $activate )
			{
				return Redirect::back()->with( 'event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> User is activated </p>' );
			}
			else
			{
				return Redirect::back()->with( 'event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try after sometime</p>' );
			}
		}
		else
		{
            App::abort(404);
		}
	}
	
	// Deactivate user
	public function deactiveUser($slug)
	{
		$query = User::where( "slug", $slug );
		
		if($query->count() > 0)
		{
			$deactivate = $query->update(['active' => 0]);

			if ( $deactivate )
			{
				return Redirect::back()->with( 'event', '<p class="alert alert-warning"> User is deactivated </p>' );
			}
			else
			{
				return Redirect::back()->with( 'event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try after sometime</p>' );
			}
		}
		else
		{
            App::abort(404);
		}
	}

}