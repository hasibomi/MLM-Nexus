<?php

class SliderController extends BaseController
{
    // Slider page
    public function index()
    {
        if ( Auth::check() )
        {
            $query = Slider::where('slider_id', '!=', 0)->get();
            
            return View::make('admin.ContentManagement.Slider', array('sliders' => $query));
        }
        else
        {
            return Redirect::route('admin-login')
			    ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
        }
    }
    
    // Add slider page
    public function addSliderPage()
    {
        if ( Auth::check() )
        {
        	$query = Slider::select('slider_id')->get();

        	foreach($query as $row)
        	{
        		$id = $row->slider_id;
        	}
            return View::make('admin.ContentManagement.AddSlider')->with('query', $id+1);
        }
        else
        {
            return Redirect::route('admin-login')
			    ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
        }
    }
    
    // Add slider
    public function addSLider()
    {
        if ( Auth::check() )
        {
            $validator = Validator::make( Input::all(),
				array(
					'slider' => 'required',
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
                $destination = base_path('/images/slider/');
				
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
        else
        {
            return Redirect::route('admin-login')
			    ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
        }
    }

	// Edit slider
	public function edit($id)
	{
		if (Auth::check())
		{
			$query = Slider::where('id', '=', $id)->get();
			
			return View::make('admin.ContentManagement.ViewSlider', array('row' => $query));
		}
		else
        {
            return Redirect::route('admin-login')
			    ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
        }
	}

	// Update slider
	public function update($id)
	{
		if ( Auth::check() )
		{
			$validator = Validator::make( Input::all(),
				array(
					'slider' => 'mimes: jpg, png, jpeg | size: 6000',
				),
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
				if (Input::file('slider') == "")
				{
					$query = Slider::find($id);

					$query->slider_text = Input::get('text');

					if ($query->save())
					{
						return Redirect::route('slider-page')->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok> Slider updated successfully</p></span>');
					}
					else
					{
						return Redirect::back()->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove> Error occured. Please try after sometime</p></span>');
					}
				}

				$file = Input::file('slider');
                $name = date('i-G-Y') . $file->getClientOriginalName();
                $destination = base_path('/images/slider/');
				
				$file->move($destination, $name);
				
				$query = Slider::find($id);
				
				$query->slider = $name;
				
				if ($query->save())
				{
					return Redirect::route('slider-page')->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok> Slider updated successfully</p></span>');
				}
				else
				{
					return Redirect::back()->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove> Error occured. Please try after sometime</p></span>');
				}
			}
		}
		else
        {
            return Redirect::route('admin-login')
			    ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
        }
	}
    
    // Change slider status
    public function changeStatus()
    {
        if ( Auth::check() )
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
        else
        {
            return Redirect::route('admin-login')
			    ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
        }
    }

    // Delete slider
    public function delete()
    {
    	if (Auth::check())
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
    	else
    	{
    		return Redirect::route('admin-login')
			    ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
    	}
    }
    
}