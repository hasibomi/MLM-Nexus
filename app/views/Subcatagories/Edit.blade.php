@extends("Main.Boilerplate")

@section("title")
    <title>Edit Sub catagory - {{ $subcatagories->first()->subcatagory_name }}</title>
@stop

@section ("content")

    <br />
    <br />
    <br />

    <div class="container">
        @foreach($subcatagories as $row)
            {{ Form::open( array("url" => "subcatagory/update/".$row->slug) ) }}

            <div class="form-group">
                <div class="row">
                    <div class="col-md-2">
                        {{ Form::label("subcatagory_name", "Sub catagory name") }}
                    </div>
                    <div class="col-md-5">
                        {{ Form::text("subcatagory_name", $value = $row->subcatagory_name, $attributes = ["class" => "form-control", "Placeholder" => "Sub catagory name"]) }}
                    </div>
                </div>
            </div> <!--end form-group-->
            <div class="form-group">
                <div class="row">
                    <div class="col-md-2">
                        {{ Form::label("catagory_type", "Assign to") }}
                    </div>
                    <div class="col-md-5">
                        <select name="catagory_id">
                            @if($catagories->count() == 0)
                                <option value="0">No catagories have been added</option>
                            @else
                                @foreach($catagories as $catagory)
                                    <option value="{{ $catagory->id }}" @if($row->catagory_id == $catagory->id) selected @endif>{{ $catagory->catagory_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div> <!--end form-group-->
            <div class="form-group">
                <div class="row">
                    <div class="col-md-offset-2 col-md-5">
                        {{ Form::submit("Submit", $attributes = ["class" => "btn btn-block btn-success"]) }}
                    </div>
                </div>
            </div> <!--end form-group-->
            {{ Form::close() }}
        @endforeach
    </div>

    <br />
    <br />
    <br />
    <br />
    <br />

@stop
