<?php

class OrderController extends BaseController
{
    public function __construct() {
        $this->beforeFilter('admin');
        $this->beforeFilter('csrf', ['on' => 'post']);
    }
	public function getIndex()
	{
        $query = Cart::where('status', '0')->paginate(10);
		return View::make('Dashboard.Orders.All', ['query' => $query]);
	}
    
    // Accept order
    public function postAccept($id)
    {
        $query = Cart::find($id);
        
        $query->status = Input::get('status');
        
        if($query->save())
        {
            return Redirect::back()->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Order accepted</p>');
        }
        
        return Redirect::back()->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured</p>');
    }
    
    // Delete order
    public function postDelete()
    {
        $query = Cart::find(Input::get('id'));
        $user = User::where('id', Input::get('user_id'))->get();
        
        // Check field
        $validator = Validator::make(Input::all(), 
            [
                'id'        => 'required',
                'user_id'   => 'required',
                'message'   => 'required'
            ]
        );
        
        if($validator->fails())
        {
            return Redirect::back()
                            ->withErrors($validator)
                            ->withInput();
        }
		
		$email = $user->first()->email;
		$name = $user->first()->name;
        
        // Send mail
        Mail::send('emails.auth.denyOrder', ['name' => $name, 'message' => Input::get('message')], function($message) use($email, $name) {
			$message->from("info@nexusitzone.com", "Nexus IT Zone");
            $message->to($email, $name)->subject('Order denied');
        });
        
        // Delete the order
        if($query->delete())
        {
            return Redirect::back()->with('event', '<p class="alert alert-success"><span class="glyphicon glyphicon-warning"></span> Order deleted</p>');
        }
        
        return Redirect::back()->with('event', '<p class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> Error occured</p>');
    }
}