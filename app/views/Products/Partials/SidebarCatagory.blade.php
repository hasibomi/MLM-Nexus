@if ($catagories->count() > 0)
    <div class="col-sm-3">
        <div class="left-sidebar">
            <h2>Category</h2>
            <div class="panel-group category-products" id="accordian"><!--category-products-->
                @foreach($catagories as $catagory)
                    @foreach($catagory->subcatagories as $sub)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                @if($catagory->id == $sub->catagory_id)
                                    <a data-toggle="collapse" data-parent="#accordian" href="#{{ $catagory->id }}">
                                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                        {{ $catagory->catagory_name }}
                                    </a>
                                    {{ Form::open(["url" => "catagory/delete_catagory/" . $catagory->id, "class" => "pull-right"]) }}
                                        <button type="submit" class="btn btn-xs btn-danger">
                                            <span class="glyphicon glyphicon-trash"></span> Delete
                                        </button>
                                    {{ Form::close() }}
                                    <a style="text-transform: none;" href="{{ url("catagory/edit_catagory/" . $catagory->slug) }}" class="btn btn-xs btn-default pull-right"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                @else
                                    <a href="{{ url('products/all/' . $catagory->id) }}">{{ $catagory->catagory_name }}</a>
                                    {{ Form::open(["url" => "catagory/delete_catagory/" . $catagory->id, "class" => "pull-right"]) }}
                                        <button type="submit" class="btn btn-xs btn-danger">
                                            <span class="glyphicon glyphicon-trash"></span> Delete
                                        </button>
                                    {{ Form::close() }}
                                    <a style="text-transform: none;" href="{{ url("catagory/edit_catagory/" . $catagory->slug) }}" class="btn btn-xs btn-default pull-right"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                @endif
                            </h4>
                        </div>
                        <div id="{{ $catagory->id }}" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul>

                                    <li><a href="{{ url('products/subcatagory/all/' . $sub->id) }}">{{ $sub->subcatagory_name }}</a></li>

                                    {{ Form::open(["url" => "subcatagory/destroy/" . $sub->id, "class" => "pull-right"]) }}
                                    <button type="submit" class="btn btn-xs btn-danger">
                                        <span class="glyphicon glyphicon-trash"></span> Delete
                                    </button>
                                    {{ Form::close() }}

                                    <a href="{{ url("subcatagory/edit/" . $sub->slug) }}" class="btn btn-xs btn-info pull-right"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endforeach
            </div><!--/category-products-->

        </div>
    </div>
@endif