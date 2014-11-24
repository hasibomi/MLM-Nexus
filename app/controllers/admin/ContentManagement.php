<?php

class ContentManagement extends BaseController
{
    // Content management page
    public function index()
    {
        if ( Auth::check() )
        {
            $query = Content::get();
            return View::make( 'admin.ContentManagement.Manage-content', array('contents' => $query) );
        }
        else
        {
            return Redirect::route('admin-login')
			    ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
        }
    }
    
    // Add content
    public function addContent()
    {
        if ( Auth::check() )
        {
            return View::make( 'admin.ContentManagement.AddContent' );
        }
        else
        {
            return Redirect::route('admin-login')
			    ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
        }
    }
	
	// Edit content page
	public function edit($id)
	{
		if (Auth::check())
		{
			$query = Content::where('id', $id)->get();
			
			return View::make('admin.ContentManagement.EditContent', array('row' => $query));
		}
		else
		{
		    return Redirect::route('admin-login')
			    ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
		}
		
	}
	
	// Update content
	public function update()
	{
		if(Auth::check())
		{
		    $validator = Validator::make(Input::all(),
				array('id' => 'required', 'title' => 'required', 'description' => 'required', 'page' => 'required'),
				array('required' => 'Fields can\'t be empty')
			);
			
			if ($validator->fails())
			{
				return Redirect::back()->withErrors($validator)->withInput();
			}
			
			$query = Content::find(Input::get('id'));
			
			$query->title           = Input::get('title');
			$query->description     = Input::get('description');
			$query->call_name       = Input::get('page');
			
			if ($query->save())
			{
				return Redirect::route('manage-content-page')->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Content successfully updated</p>');
			}
			else
			{
				return Redirect::route('manage-content-page')->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try after sometime</p>');
			}
			
		}
		else
		{
		    return Redirect::route('admin-login')
			    ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
		}
		
	}

    // Update image
    public function updateUpload()
    {
        if(Auth::check())
        {
            $file = Input::file('file');
            $destination = public_path() . '/images/content';

            $file->move($destination, $file->getClientOriginalName());

            return Response::json(['filelink' => '/images/content/'.$file->getClientOriginalName()]);
        }
        else
        {
            return Redirect::route('admin-login')
                ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
        }
    }
	
	
	// Delete a content
	public function delete()
	{
		if (Auth::check())
		{
			$validator = Validator::make(Input::all(), array('id' => 'required'));
			$query = Content::find(Input::get('id'));
			
			if ($query->delete())
			{
			    return Redirect::back()->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Content successfully deleted</p>');
			}
			else
			{
			    return Redirect::back()->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try after sometime</p>');
			}
		}
		else
		{
		    return Redirect::route('admin-login')
			    ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
		}
		
	}
	
	

    // Change settings page
    public function settings()
    {
        if ( Auth::check() )
        {
            return View::make( 'admin.ContentManagement.ChangeSettings' );
        }
        else
        {
            return Redirect::route('admin-login')
                ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
        }
    }

    // Change settings
    public function change()
    {
        if ( Auth::check() )
        {
            $slider = Slider::find(1);
			
			$slider->active = Input::get('slider');
			$slider->save();
			
			return Redirect::route('manage-content-page')->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Settings successfully changed</p>');
        }
        else
        {
            return Redirect::route('admin-login')
                ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
        }
    }

    // Store content
    public function store()
    {
        if ( Auth::check() )
        {
            $validator = Validator::make(Input::all(),
                array(
                    'title'         => 'required',
                    'description'   => 'required',
                    'page'          => 'required'
                )
            );

            if ( $validator->fails() )
            {
                return Redirect::back()
                	->withErrors($validator)
                	->withInput();
            }
            else
            {
                $content = new Content;

                $content->title = Input::get('title');
                $content->description = Input::get('description');
                $content->call_name = Input::get('page');

                if ( $content->save() )
                {
                    return Redirect::route('manage-content-page')
                                    ->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Content added successfully</p>');
                }
                else
                {
                    return Redirect::route('add-content-page')
                        ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try after sometime</p>');
                }
            }
        }
        else
        {
            return Redirect::route('admin-login')
                ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
        }
    }

    // Upload image
    public function upload()
    {
        if (Auth::check())
        {
            $file = Input::file('file');
            $destination = public_path() . '/images/content/';

            $file->move($destination, $file->getClientOriginalName());

            return Response::json(['filelink' => '/images/content/'.$file->getClientOriginalName()]);
        }
        else
        {
            return Redirect::route('admin-login')
                ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
        }
    }
    
    // Change status
    public function status()
    {
        if (Auth::check())
        {
            $content = Content::find(Input::get('id'));

            $content->active = Input::get('status');

            if ($content->save())
            {
                return Redirect::back()->with('event', (Input::get('status') == 0) ? '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Content has been deactivated</p>' : '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Content has been activated</p>');
            }
            else
            {
                return Redirect::back()->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try after sometime</p>');
            }
        }
        else
        {
            return Redirect::route('admin-login')
                ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
        }
    }
    

    
}
