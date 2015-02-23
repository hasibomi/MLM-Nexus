<?php
$select_profile = User::where('id', '=', Auth::id())->get();
?>
<h3><small>You have</small> {{ $point }} | {{ $amount }}</h3>

@foreach($select_profile as $profile)

@if ($profile->profile_picture == "")
    <p>No profile image</p>
@else
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <img src="{{ asset($profile->profile_picture) }}" width="200" class="img-responsive" alt="" />
            </div>
            <div class="row">
                <h4><i>{{ $profile->designation }}</i></h4>
            </div>
            <div class="row">
                {{ Form::open(array('url' => 'upload', 'files' => true)) }}
                    {{ Form::file('propic') }}
                    <br />
                    {{ Form::submit('Upload', $attributes = ['class' => 'btn btn-success btn-sm']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endif
{{ Form::open(["url" => "account/update"]) }}
    <div class="col-md-9">
        <div class="row">
            <h2>
                <div class="col-md-5"><label>My ID - <a>{{ $profile->id }}</a></label></div>
            </h2>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label>Name</label>
                </div>
                <div class="col-md-9">
                    {{ Form::text("name", $profile->name, ["class" => "form-control", "readonly" =>true]) }}
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label>Date of birth</label>
                </div>
                <div class="col-md-9">
                    {{ Form::text("name", $profile->date_of_birth . "/" . $profile->month_of_birth . "/" .$profile->year_of_birth, ["class" => "form-control", "readonly" =>true]) }}
                </div>
            </div>
        </div>

        <!-- Gender -->
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label>Gender</label>
                </div>
                <div class="col-md-9">
                    {{ Form::text("gender", $profile->gender, ["class" => "form-control", "readonly" =>true]) }}
                </div>
            </div>
        </div>

        <!-- Permanent address -->
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label>Permanent Address</label>
                </div>
                <div class="col-md-9">
                    {{ Form::textarea("permanent_address", $profile->permanent_address, ["class" => "form-control"]) }}
                </div>
            </div>
        </div>

        <!-- Present Address -->
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label>Present Address</label>
                </div>
                <div class="col-md-9">
                    {{ Form::textarea("present_address", $profile->present_address, ["class" => "form-control"]) }}
                </div>
            </div>
        </div>

        <!-- Password -->
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label>Current Password</label>
                </div>
                <div class="col-md-9">
                    {{ Form::password("current_password", ["class" => "form-control"]) }}
                </div>
            </div>
        </div>

        <!-- New Password -->
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label>New Password</label>
                </div>
                <div class="col-md-9">
                    {{ Form::password("password", ["class" => "form-control"]) }}
                </div>
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label>Confirm Password</label>
                </div>
                <div class="col-md-9">
                    {{ Form::password("password_confirmation", ["class" => "form-control"]) }}
                </div>
            </div>
        </div>

        <div class="row">
            <small>*Please write your old password to change current password</small>
        </div>

        @if($profile->referal_id != 0)
            <div class="row">
                <div class="col-md-3"><label>Referred From</label></div>
                <div class="col-md-9">: {{ $profile->referal_id  }} - {{ User::where("id", $profile->referal_id)->get()->first()->name }}></div>
            </div>
        @endif
        <div class="form-group">
            <div class="row">
                {{ Form::submit("Update Profile", ["class" => "btn btn-block btn-default"]) }}
            </div>
        </div>
        <div class="row">
            <a href="{{ url('#referalModal') }}" data-toggle="modal" data-target="#referalModal" class="btn btn-block btn-info">
                Refer a friend
            </a>
        </div>
    </div>
{{ Form::close() }}

@include("Users.Partials.ReferalModal")
@endforeach