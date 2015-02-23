@extends("Main.Boilerplate")

@section("title")
    <title>Account recovery</title>
@stop

@section("content")

<section>
    <section class="container">
        <!-- Error messages -->
        @include('Partials.Event')

        <div class="row">
            {{ Form::open(["url" => "account/recovery/recover"]) }}
                <!-- .form-group -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-1">
                            {{ Form::label("email", "Email") }}
                        </div>
                        <div class="col-md-5">
                            {{ Form::email("email", "", ["class" => "form-control", "placeholder" => "Your email"]) }}
                        </div>
                    </div>
                </div>

                <!-- .form-group -->
                <div class="form-group">
                    <div class="row">

                        <!-- date of birth -->
                        <div class="col-md-1">
                            {{ Form::label("date_of_birth", "Date of birth") }}
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" name="date_of_birth">
                                @for($date = 1; $date <= 31; $date++)
                                    <option value="{{ $date }}">{{ $date }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- month of birth -->
                        <div class="col-md-1">
                            {{ Form::label("month_of_birth", "Month") }}
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" name="month_of_birth">
                                @for($month = 1; $month <= 12; $month++)
                                    <option value="{{ $month }}">{{ $month }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- year of birth -->
                        <div class="col-md-1">
                            {{ Form::label("year_of_birth", "Year") }}
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" name="year_of_birth">
                                @for($year = 1900; $year <= date('Y'); $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Submit button -->
                <div class="form-group">
                    <div class="row">
                        {{ Form::submit("Recover", ["class" => "btn btn-primary btn-block"]) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </section>
</section>

@stop