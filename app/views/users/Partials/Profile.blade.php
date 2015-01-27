<?php
$select_profile = User::where('id', '=', Auth::id())->get();
?>
<h3>You have {{ $point }}</h3>

@foreach($select_profile as $profile)

@if ($profile->profile_picture == "")
<p>No profile image</p>
@else
<div class="col-md-3">
    <div class="row">
        <img src="{{ $profile->profile_picture }}" width="200" class="img-responsive" alt="" />
    </div>
    <div class="row">
        <h4><i>{{ $profile->designation }}</i></h4>
    </div>
</div>
@endif
<div class="col-md-9">
    <div class="row">
        <div class="col-md-3">
            <label>Name</label>
        </div>
        <div class="col-md-9">
            : {{ $profile->name }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label>Date of birth</label>
        </div>
        <div class="col-md-9">
            : {{ $profile->date_of_birth }}/{{ $profile->month_of_birth }}/{{ $profile->year_of_birth }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label>Permanent Address</label>
        </div>
        <div class="col-md-9">
            : {{ $profile->permanent_address }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label>Present Address</label>
        </div>
        <div class="col-md-9">
            : {{ $profile->present_address }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"><label>Referral ID</label></div>
        <div class="col-md-9">
            <a href="{{ url('#referalModal') }}" data-toggle="modal" data-target="#referalModal">
                {{ $profile->id }} - <u>Refer a friend</u>
            </a>
        </div>
    </div>
</div>

@include("Users.Partials.ReferalModal")
@endforeach