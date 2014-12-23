<?php

class ContentManagement extends BaseController
{
    // Content management page
    public function index()
    {
		$query = Content::get();
		return View::make( 'Dashboard.ContentManagement.All', array('contents' => $query) );
    }
    
    // Add content
    public function addContent()
    {
		return View::make( 'Dashboard.ContentManagement.Add' );
    }
	
	// Edit content page
	public function edit($id)
	{
			$query = Content::where('id', $id);
			
			if($query->count() == 1) return View::make('Dashboard.ContentManagement.Edit', array('row' => $query));
			
			else return Redirect::back()->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Nothing found</p>');
		
	}
	
	// Update content
	public function update()
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
			return Redirect::back()->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Content successfully updated</p>');
		}
		else
		{
			return Redirect::back()->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try after sometime</p>');
		}		
	}

    // Update image
    public function updateUpload()
    {
		$file = Input::file('file');
		$destination = 'images/content';

		$file->move($destination, $file->getClientOriginalName());

		return Response::json(['filelink' => asset('images/content/'.$file->getClientOriginalName())]);
    }
	
	// Delete a content
	public function delete()
	{
		$validator = Validator::make(Input::all(), array('id' => 'required'));
		$query = Content::find(Input::get('id'));

		if ($query)
		{
			$query->delete();
					
			return Redirect::back()->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Content successfully deleted</p>');
		}
		else
		{
			return Redirect::back()->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try after sometime</p>');
		}
		
	}
	
	

    // Change settings page
    public function settings()
    {
		return View::make( 'Dashboard.ContentManagement.Settings' );
    }

    // Change settings
    public function change()
    {
		$slider = Slider::find(1);

		$slider->active = Input::get('slider');
		$slider->save();

		return Redirect::route('cms')->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Settings successfully changed</p>');
    }

    // Store content
    public function store()
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
				return Redirect::back()
								->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Content added successfully</p>');
			}
			else
			{
				return Redirect::back()
					->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try after sometime</p>');
			}
		}
    }

    // Upload image
    public function upload()
    {
		$file = Input::file('file');
		$destination = 'images/content/';

		$file->move($destination, $file->getClientOriginalName());

		return Response::json(['filelink' => asset('images/content/'.$file->getClientOriginalName())]);
    }
    
    // Change status
    public function status()
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
    

    
}
