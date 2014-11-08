<?php

class UserManagement extends BaseController
{
	// User management page
	public function userManagementPage()
	{
		if ( Auth::check() )
		{
			$user = User::where( 'id', '!=', Auth::id() )->get();
			return View::make('admin.usermanagement', array('users' => $user));
		}
		else
		{
			return Redirect::route('admin-login')
					  ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
		}
	}
	
	// View user
	public function viewUser($id)
	{
		if ( Auth::check() )
		{
			$user = User::where( 'id', '=', $id )->get();
			return View::make( 'admin.view-user', array( 'user' => $user ) );
		}
		else
		{
			return Redirect::route('admin-login')
					  ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
		}
	}
	
	// Activate user
	public function activeUser($id)
	{
		if ( Auth::check() )
		{
			$query = User::find( $id );
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
			return Redirect::route('admin-login')
					  ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
		}
	}
	
	// Deactivate user
	public function deactiveUser($id)
	{
		if ( Auth::check() )
		{
			$query = User::find( $id );
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
			return Redirect::route('admin-login')
					  ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
		}
	}
	
	
	
	
	
	
	
	
}