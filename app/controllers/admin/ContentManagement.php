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
            return View::make( 'admin.ContentManagement.ChangeSettings' );
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

            if ( $validator->fails() == true)
            {
                return Redirect::route('add-content');
            }
            else
            {
                $content = new Content;

                $content->title = Input::get('title');
                $content->description = Input::get('description');
                $content->call_name = Input::get('page');

                if ( $content->save() )
                {
                    return Redirect::route('add-content-page')
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
    
    

    
}
