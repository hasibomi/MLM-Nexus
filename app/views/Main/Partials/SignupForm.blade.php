{{Form::open(array('url' => 'signup'))}}
{{ Form::label("name", "Name") }}
{{ Form::text('name', $value=Input::old('name'), $attributes = ['placeholder' => 'Name', 'required' => 'required']) }}
@if($errors->has('name'))
    {{ $errors->first('name') }}
@endif

{{ Form::label("email", "Email") }}
{{ Form::email('email', $value=Input::old('email'), $attributes = ['placeholder' => 'Email Address', 'required' => 'required']) }}
@if ($errors->has('email'))
    {{ $errors->first('email') }}
@endif

{{ Form::label("password", "Password") }}
{{ Form::password('password', $attributes = ['placeholder' => 'Password', 'required' => 'required']) }}
@if ($errors->has('password'))
    {{ $errors->first('password') }}
@endif

{{ Form::label("confirm_password", "Confirm Password") }}
{{ Form::password('confirm_password', $attributes = ['placeholder' => 'Confirm Password', 'required' => 'required']) }}
@if ($errors->has('confirm_password'))
    {{ $errors->first('confirm_password') }}
@endif

{{ Form::label("gender", "Gender") }}
<select name="gender">
    <option>Male</option>
    <option>Female</option>
</select>
<br />
<br />
<p>Date of birth</p>
<div class="col-md-4">
    <select name="date">
        <option>Date</option>
        @for($i = 1; $i <= 31; $i++)
            <option>{{ $i }}</option>
        @endfor
    </select>
</div>
<div class="col-md-4">
    <select name="month">
        <option>Month</option>
        @for($i = 1; $i <= 12; $i++)
            <option>{{ $i }}</option>
        @endfor
    </select>
</div>
<div class="col-md-4">
    <select name="year">
        <option>Year</option>
        @for($i = 1900; $i <= 2050; $i++)
            <option>{{ $i }}</option>
        @endfor
    </select>
</div>
<br />
<br />

{{ Form::label("present_address", "Present Address") }}
{{ Form::textarea('present_address', $value = Input::old("present_address"), $attributes = ['placeholder' => 'Present Address']) }}
@if($errors->has("present_address"))
    {{ $errors->first("present_address") }}
@endif
<br /><br />

{{ Form::label("permanent_address", "Permanent Address") }}
{{ Form::textarea('permanent_address', $value = Input::old("permanent_address"), $attributes = ['placeholder' => 'Permanent Address']) }}
@if($errors->has("permanent_address"))
    {{ $errors->first("permanent_address") }}
@endif
<br /><br />

{{ Form::label("referal_id", "Referal ID") }}
{{ Form::text('referal_id', $value = null, $attributes = ['placeholder' => 'Referal ID', 'id' => 'referal_id']) }}
<br />

<div id="hand"></div>

<button type="submit" class="btn btn-default">Signup</button>
{{ Form::close() }}