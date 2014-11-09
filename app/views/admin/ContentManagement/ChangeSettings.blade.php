@extends('admin.layouts.main')

@section('content')

    <div class="container">

        <div class="panel panel-primary">

            <div class="panel-heading">
                <h3 class="panel-title">Settings</h3>
            </div>

            <div class="panel-body">

                {{ Form::open(array('url' => 'changeSettings')) }}

                    <fieldset>
                        <legend>Home Page</legend>
                    </fieldset>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                {{ Form::label('slider', 'Show slider') }}
                            </div>
                            <div class="col-md-2">
                                {{ Form::radio('slider', '1') }} Yes
                                {{ Form::radio('slider', '0') }} No
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">{{ Form::label('product', 'Show products') }}</div>
                            <div class="col-md-2">
                                {{ Form::radio('product', '1') }} Yes
                                {{ Form::radio('product', '0') }} No
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">{{ Form::label('catagory', 'Show catagories') }}</div>
                            <div class="col-md-2">
                                {{ Form::radio('catagory', '1') }} Yes
                                {{ Form::radio('catagory', '0') }} No
                            </div>
                        </div>
                    </div>

                {{ Form::close() }}

            </div>

        </div>

    </div>
    {{-- /.container --}}

@stop