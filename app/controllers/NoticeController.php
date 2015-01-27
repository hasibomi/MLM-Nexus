<?php
class NoticeController extends BaseController
{
	public function __construct()
	{
		$this->beforeFilter("csrf", ["on" => "post", "except" => "postUpload"]);
	}
	
	// Get index page
	public function getIndex()
	{
		$notices = Notice::all();
		
		return View::make("Dashboard.Notices.All")
			->with("notices", $notices);
	}
	
	// Edit page
	public function getEdit($id)
	{
		$query = Notice::where("id", "=", $id)->get();
		
		return View::make("Dashboard.Notices.Edit")
			->with("notices", $query);
	}
	
	// Update notice
	public function postUpdate($id)
	{
		$validator = Validator::make(Input::all(), Notice::$rules);

		if($validator->passes())
		{
			if(Input::get("user") == 0)
			{
				$query = Notice::find($id);
				
				if($query)
				{
					$query->body = Input::get("body");
					$query->associated_users = "";
					
					if($query->save())
					{
						return Redirect::to("dashboard/notice")
							->with("event", "<p class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> Notice updated</p>");
					}
					else
					{
						return Redirect::back()
							->with("event", "<p class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Update failed. Please try again.</p>");
					}
				}
			}
			else
			{
				$query = Notice::find($id);
				
				if($query)
				{
					$query->body = Input::get("body");
					
					if($query->save())
					{
						return View::make("Dashboard.Notices.EditBrowseUser")
							->with("notice", Input::get("noticeId"))
							->with("notices", NoticeUserAssociate::where("notice_id", Input::get("noticeId"))->get())
							->with("users", User::all());
					}
					else
					{
						return Redirect::back()
							->with("event", "<p class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Update failed. Please try again.</p>");
					}
				}
			}
		}

		return Redirect::back()
			->withErrors($validator)
			->withInput();
	}
	
	// Update assign user
	public function postUpdateassignuser($id)
	{
		if(Input::has("users"))
		{
			$users = "";

			foreach(Input::get("users") as $user)
			{
				$insert = ["notice_id" => $id, "user_id" => $user];
				$inserts[] = $insert;
				$users .= '<a href="'.url('dashboard/user/' . $user) .'">' . $user . '</a>' . ", ";
			}

			$users = rtrim($users, ", ");

			DB::table("notices")->where("notice_id", $id)->update(["user_id" => $users]);

			$create = DB::table("notice_user_associates")->where("notice_id", $id)->update($inserts);

			if($create)
			{
				return Redirect::to("dashboard/notice/store")
					->with("event", "<p class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> Notice created. You can add another.</p>");
			}

			return Redirect::back()
				->with("event", "<p class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Error occured. Please try after sometime</p>");
		}
		
		return Redirect::to("dashboard/notice");
	}
	
	// Delete notice
	public function postDelete()
	{
		$query = Notice::find(Input::get("id"));
		
		if($query->delete())
		{
			return Redirect::back()
				->with("event", "<p class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> Notice deleted.</p>");
		}
		
		return Redirect::back()
			->with("event", "<p class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Error occured. Please try after sometime.</p>");
	}
	
	// Add notice page
	public function getStore()
	{
		return View::make("Dashboard.Notices.Add")
			->with("users", User::all());
	}
	
	// Add notice
	public function postAdd()
	{
		$validator = Validator::make(Input::all(), Notice::$rules);
		
		if($validator->passes())
		{
			if(Input::get("user") == 0)
			{
				$notice = new Notice;
				$notice->notice_id = Input::get("noticeId");
				$notice->body = Input::get("body");
				
				if($notice->save())
				{
					return Redirect::back()
						->with("event", "<p class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> Notice created. You can add another.</p>");
				}
				
				return Redirect::back()
					->with("event", "<p class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Error occured. Please try after sometime</p>");
			}
			else
			{
				$notice = new Notice;
				$notice->notice_id = Input::get("noticeId");
				$notice->body = Input::get("body");
				
				if($notice->save())
				{
					return View::make("Dashboard.Notices.BrowseUser")
						->with("notice", Input::get("noticeId"))
						->with("users", User::all());
				}
				
				return Redirect::back()
					->with("event", "<p class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Error occured. Please try after sometime</p>");
			}
		}
		
		return Redirect::back()
			->withErrors($validator)
			->withInput();
	}
	
	// Assign User
	public function postAssignuser($id)
	{
		if(Input::has("users"))
		{
			$users = "";

			foreach(Input::get("users") as $user)
			{
				$insert = ["notice_id" => $id, "user_id" => $user];
				$inserts[] = $insert;
				$users .= '<a href="'.url('dashboard/user/' . $user) .'">' . $user . '</a>' . ", ";
			}

			$users = rtrim($users, ", ");

			DB::table("notices")->where("notice_id", $id)->update(["user_id" => $users]);

			$create = DB::table("notice_user_associates")->insert($inserts);

			if($create)
			{
				return Redirect::to("dashboard/notice/store")
					->with("event", "<p class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> Notice created. You can add another.</p>");
			}

			return Redirect::back()
				->with("event", "<p class='alert alert-danger'><span class='glyphicon glyphicon-remove'></span> Error occured. Please try after sometime</p>");
		}
		
		return Redirect::to("dashboard/notice");
	}
	
	// Upload image
    public function postUpload()
    {
		$file = Input::file('file');
		$destination = 'images/notice/';

		if($file->move($destination, $file->getClientOriginalName()))
		{
			return Response::json(['filelink' => asset('images/notice/'.$file->getClientOriginalName())]);
		}
		else
		{
			return Response::json(['error' => true]);
		}
    }
}