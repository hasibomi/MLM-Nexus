@extends("Main.Boilerplate")

@section("title")
    <title>Account recovery</title>
@stop

@section("content")
    <section>
        <section class="container">
            <div class="row">
                {{ Form::open(["url" => "account/recovery/newpassword"]) }}
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">{{ Form::label('password', 'New Password') }}</div>
                        <div class="col-md-6">
                            {{ Form::password('password', '', ['class' => 'form-control', 'placeholder' => 'New password']) }}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">{{ Form::label('password_confirmation', 'Confirm Password') }}</div>
                        <div class="col-md-6">
                            {{ Form::password('password_confirmation', '', ['class' => 'form-control', 'placeholder' => 'Confirm password']) }}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        {{ Form::submit('Submit', ['class' => 'btn btn-success btn-block']) }}
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </section>
    </section>
 @stop