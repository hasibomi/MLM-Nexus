<?php

class UserManagement extends BaseController
{
	// User management page
	public function userManagementPage()
	{
		$user = User::where( 'id', '!=', Auth::id() )->get();
		
		return View::make('Dashboard.UserManagement.All', array('users' => $user));
	}
	
	// View user
	public function viewUser($id)
	{
		$user = User::where( 'id', '=', $id )->get();
		
		return View::make( 'Dashboard.UserManagement.Edit', array( 'user' => $user ) );
	}
	
	// Activate user
	public function activeUser($id)
	{
		$query = User::find( $id );
		
		if($query)
		{
			$query->active = 1;

			if ( $query->save() )
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
			return Redirect::back()->with( 'event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try after sometime</p>' );
		}
	}
	
	// Deactivate user
	public function deactiveUser($id)
	{
		$query = User::find( $id );
		
		if($query)
		{
			$query->active = 0;

			if ( $query->save() )
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
			return Redirect::back()->with( 'event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try after sometime</p>' );
		}
	}

}