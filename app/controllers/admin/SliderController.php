<?php

class SliderController extends BaseController
{
    // Slider page
    public function index()
    {
		$query = Slider::where('slider_id', '!=', 0)->get();

		return View::make('Dashboard.ContentManagement.Sliders.All', array('sliders' => $query));
    }
    
    // Add slider page
    public function addSliderPage()
    {
		$query = Slider::select('slider_id')->get();

		foreach($query as $row)
		{
			$id = $row->slider_id;
		}
		return View::make('Dashboard.ContentManagement.Sliders.Add')->with('query', $id+1);
    }
    
    // Add slider
    public function addSLider()
    {
		$validator = Validator::make( Input::all(),
			array(
				'slider' => 'required | image | mimes:jpg, jpeg, png, gif | max:6000',
			),
			array(
				'required'			=> '<span class="glyphicon glyphicon-exclamation-sign"></span> Please insert at least 1 image',
				'mimes'				=> '<span class="glyphicon glyphicon-remove"></span> Unknown file inserted',
				'size'				=> '<span class="glyphicon glyphicon-exclamation-sign"></span> Size must be less than 6 MB'
			)
		);

		if ( $validator->fails() )
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		else
		{
			$file = Input::file('slider');
			$name = date('i-G-Y') . $file->getClientOriginalName();
			$destination = 'images/slider/';

			$file->move($destination, $name);

			$query = new Slider;

			$query->slider_id 		= Input::get('getId');
			$query->slider_text 	= Input::get('text');
			$query->slider 			= $name;

			if ($query->save())
			{
				return Redirect::route('slider-page')->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Slider added successfully</p>');
			}
			else
			{
				return Redirect::back()->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove> Error occured. Please try after sometime</p></span>');
			}
		}
    }

	// Edit slider
	public function edit($id)
	{
		$query = Slider::where('id', '=', $id)->get();

		return View::make('Dashboard.ContentManagement.Sliders.Edit', array('row' => $query));
	}

	// Update slider
	public function update($id)
	{
		$validator = Validator::make(
			array('slider' => Input::file('slider')),
			array("slider" => "image | mimes:jpeg, jpg, png, gif | max: 6000"),
			array(
				'mimes'				=> '<span class="glyphicon glyphicon-remove"></span> Unknown file inserted',
				'size'				=> '<span class="glyphicon glyphicon-exclamation-sign"></span> Size must be less than 6 MB'
			)
		);

		if ( $validator->fails() )
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		else
		{
			if (Input::file('slider') != '')
			{
				$file = Input::file('slider');
				$name = date('i-G-Y') . $file->getClientOriginalName();
				$destination = 'images/slider/';

				$file->move($destination, $name);

				$query = Slider::find($id);

				$query->slider = $name;
				$query->slider_text = Input::get('text');

				if ($query->save())
				{
					return Redirect::route('slider-page')->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Slider updated successfully</p>');
				}
				else
				{
					return Redirect::back()->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try after sometime</p>');
				}
			}
			else
			{
				$query = Slider::find($id);

				$query->slider_text = Input::get('text');

				if ($query->save())
				{
					return Redirect::route('slider-page')->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Slider updated successfully</p>');
				}
				else
				{
					return Redirect::back()->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try after sometime</p>');
				}
			}
		}
	}
    
    // Change slider status
    public function changeStatus()
    {
		$validator = Validator::make(Input::all(), array('id' => 'required', 'status' => 'required'));

		if ($validator->fails() == true)
		{
			return Redirect::back()->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> ID and Status are required</p>');
		}
		else
		{
			$query = Slider::find(Input::get('id'));

			$query->active = Input::get('status');

			if ($query->save())
			{
				if (Input::get('status') == 1)
				{
					return Redirect::back()->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Successfully activated</p>');
				}
				else
				{
					return Redirect::back()->with('event', '<p class="alert alert-warning"><span class="glyphicon glyphicon-exclamation-sign"></span> Slider has been deactivated</p>');
				}
			}
			else
			{
				return Redirect::back()->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try after sometime</p>');
			}
		}
    }

    // Delete slider
    public function delete()
    {
		$slider = Slider::find(Input::get('id'));

		if ($slider->delete())
		{
			return Redirect::back()->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Successfully deleted</p>');
		}
		else
		{
			return Redirect::back()->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured. Please try after sometime</p>');
		}
    }
    
}