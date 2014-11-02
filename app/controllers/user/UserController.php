<?php

class UserController extends BaseController {
	/**
	 * View Index page for autheticated users
	 */
	public function home()
	{
		if (Auth::check()) {
			return View::make('users.index');
		} else {
			return Redirect::route('login')
							->with('unauthorised', 'You are not loged in. Please Login first');
		}
	}
	
	public function account()
	{
		if (Auth::check()) {
			$query = User::select('referal_id', 'active')->where('referal_id', '=', Auth::id())->where('active', '=', '1');
			
			if ($query->count() == 0) {
				$total = $query->count();
			} else {
				$total = $query->count();
			}
			
			$ungrouped_total = User::where('referal_id', '=', Auth::id())->where('arrange_group', '=', 'ungrouped')->get();
						
			$left_count = User::where('referal_id', '=', Auth::id())->where('arrange_group', '=', 'left_side')->get();
			
			if ($left_count->count() == 0) {
				$left = $left_count->count();
			} else {
				$left = $left_count->count();
			}
			
			$right_count = User::where('referal_id', '=', Auth::id())->where('arrange_group', '=', 'right_side')->get();
			
			if ($right_count->count() == 0) {
				$right = $right_count->count();
			} else {
				$right = $right_count->count();
			}
			
			return View::make('users.account', array(
												'total' 			=> $total,
												'left' 				=> $left,
												'right' 			=> $right,
												'ungrouped' 		=> $ungrouped_total,
												'left_member'		=> $left_count,
												'right_member'		=> $right_count
												)
							);
		} else {
			return Redirect::route('login')
							->with('unauthorised', 'You are not loged in. Please Login first');
		}
	}
}

?>