<?php

class SubcatagoryController extends BaseController
{
    /**
     * Add  sub catagory page
     */
    public function add()
    {
        return View::make('Subcatagories.Add')
            ->with("catagories", Catagory::all());
    }

    /**
     * Edit sub catagory page
     */
    public function edit($slug)
    {
        $catagories = Subcatagory::where('slug', '=', $slug);

        if($catagories->count() > 0)
        {
            return View::make('Subcatagories.Edit')
                ->with('catagories', Catagory::all())
                ->with('subcatagories', $catagories->get());
        }
        else
        {
            App::abort(404);
        }
    }

    /**
     * Add a sub catagory
     */
    public function store()
    {
        $validator = Validator::make(Input::all(),
            array(
                'subcatagory_name'		=> 'required|unique:subcatagories'
            ),

            array(
                'required'		=> '<div class="col-md-3 alert alert-danger">Please write a catagory name</div>',
                'unique'		=> '<div class="col-md-3 alert alert-danger"><b>'.Input::get('subcatagory_name').'</b> alredy exists</div>'
            )
        );

        if ($validator->fails() == TRUE)
        {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        else
        {
            $catagory = new Subcatagory;

            $catagory->subcatagory_name = Input::get('subcatagory_name');
            $catagory->slug = Str::slug(Input::get('subcatagory_name'));
            $catagory->catagory_id = Input::get('catagory_id');

            if ($catagory->save())
            {
                return Redirect::back()
                    ->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Catagory added successfully.</p>');
            }
            else
            {
                return Redirect::back()
                    ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error happened. Please try after sometime.</p>');
            }
        }
    }

    /**
     * Edit sub catagory
     */
    public function update($slug)
    {
        $validator = Validator::make(Input::all(), array(
                'subcatagory_name'		=> 'required',
                'catagory_id'		=> 'required'
            )
        );

        if ($validator->fails() == TRUE) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $catagory = Subcatagory::where("slug", $slug);

            $update = $catagory->update(
                [
                    'subcatagory_name'  => Input::get("subcatagory_name"),
                    'slug'              => Str::slug(Input::get('subcatagory_name')),
                    'catagory_id'       => Input::get('catagory_id')
                ]
            );

            if ($update) {
                return Redirect::to('shop')
                    ->with("event", '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Catagory has been successfully modified</p>');
            } else {
                return Redirect::back()
                    ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error happened. Please try after sometime.</p>');
            }
        }
    }

    /**
     * Delete sub catagory
     */
    public function destroy($slug)
    {
        $catagory = Subcatagory::where("slug", $slug);

        if($catagory->count() > 0)
        {
            if ( $catagory->delete() ) {
                return Redirect::back()
                    ->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Sub catagory has been successfully deleted</p>');
            } else {
                return Redirect::back()
                    ->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Something went wrong. Please try after sometime</p>');
            }
        }
        else
        {
            App::abort(404);
        }
    }

    // Find subcatagory from catagory post request
    public function findSubcatagory()
    {
        $input = Input::get("catagory");

        $subcatagorys = Subcatagory::where('catagory_id', $input);

        if($subcatagorys->count() > 0)
        {
            foreach($subcatagorys->get() as $subcatagory)
            {
                echo '<option value="'.$subcatagory->id.'">'.$subcatagory->subcatagory_name.'</option>';
            }
        }
    }
}