<?php

class SliderController extends BaseController
{
    // Slider page
    public function index()
    {
        if ( Auth::check() )
        {
            return View::make('admin.ContentManagement.Slider');
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
            return View::make('admin.ContentManagement.AddSlider');
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
            $validator = Validator::make(Input::all(),
                [
                    'slider1' => 'required_without:slider2,slider3,slider4,slider5,slider6',
                ]
            );
            
            if ($validator->fails() == true)
            {
                return Redirect::route('add-slider-page')->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> Please insert at least 1 image!</p>');
            }
            else
            {
                if (Input::file('slider1') != "")
                {
                    $file1 = Input::file('slider1');
                    $size1 = $file1->getSize() / 1000;
                    $name1 = $file1->getClientOriginalName();
                    $type1 = $file1->getMimeType();
                    $destination = base_path('/mlm/images/slider/');

                    $file1->move($destination, $name1);
                }
                else
                {
                    $file1 = '';
                    $slider1 = '';
                    $size1   = '';
                    $name1   = '';
                    $type1 = '';
                }

                if (Input::file('slider2') != "")
                {
                    $file2 = Input::file('slider2');
                    $size2 = $file2->getSize() / 1000;
                    $name2 = $file2->getClientOriginalName();
                    $type2 = $file2->getMimeType();
                    $destination = base_path('/mlm/images/slider/');

                    $file2->move($destination, $name2);
                }
                else
                {
                    $file2 = '';
                    $slider2 = '';
                    $size2   = '';
                    $name2   = '';
                    $type2   = '';
                }

                if (Input::file('slider3') != "")
                {
                    $file3 = Input::file('slider3');
                    $size3 = $file3->getSize() / 1000;
                    $name3 = $file3->getClientOriginalName();
                    $type3 = $file3->getMimeType();
                    $destination = base_path('/mlm/images/slider/');

                    $file3->move($destination, $name3);
                }
                else
                {
                    $file3 = '';
                    $slider3 = '';
                    $size3   = '';
                    $name3   = '';
                    $type3   = '';
                }

                if (Input::file('slider4') != "")
                {
                    $file4 = Input::file('slider4');
                    $size4 = $file4->getSize() / 1000;
                    $name4 = $file4->getClientOriginalName();
                    $type4 = $file4->getMimeType();
                    $destination = base_path('/mlm/images/slider/');

                    $file4->move($destination, $name4);
                }
                else
                {
                    $file4 = '';
                    $slider4 = '';
                    $size4   = '';
                    $name4   = '';
                    $type4 = '';
                }

                if (Input::file('slider5') != "")
                {
                    $file5 = Input::file('slider5');
                    $size5 = $file5->getSize() / 1000;
                    $name5 = $file5->getClientOriginalName();
                    $type5 = $file5->getMimeType();
                    $destination = base_path('/mlm/images/slider/');

                    $file5->move($destination, $name5);
                }
                else
                {
                    $file5 = '';
                    $slider5 = '';
                    $size5   = '';
                    $name5   = '';
                    $type5 = '';
                }

                if (Input::file('slider6') != "")
                {
                    $file6 = Input::file('slider6');
                    $size6 = $file6->getSize() / 1000;
                    $name6 = $file6->getClientOriginalName();
                    $type6 = $file6->getMimeType();
                    $destination = base_path('/mlm/images/slider/');

                    $file6->move($destination, $name6);
                }
                else
                {
                    $file6 = '';
                    $slider6 = '';
                    $size6   = '';
                    $name6   = '';
                    $type6 = '';
                }

                $slider = new Slider;

                $slider->slider_text    = Input::get('text');
                $slider->slider1        = $name1;
                $slider->slider2        = $name2;
                $slider->slider3        = $name3;
                $slider->slider4        = $name4;
                $slider->slider5        = $name5;
                $slider->slider6        = $name6;
                $slider->slider_id      = Input::get('getId');

                if ($slider->save())
                {
                    return Redirect::route('slider-page')->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Slider added successfully</p>');
                }
                else
                {
                    return Redirect::back()->with('event', '<p class="alert alert-danger">Error occured. Please try after sometime</p>');
                }
            }
        }
        else
        {
            return Redirect::route('admin-login')
			    ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> You are not loged in!</p>');
        }
    }
    
    
}