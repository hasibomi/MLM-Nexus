@extends('Dashboard.Main.Boilerplate')

@section('css')
  {{ HTML::style('redactor/redactor.css')}}
@stop

@section('content')
    
    <div class="container">

        @if ($errors->all())
            
            @foreach($errors->all() as $error)
                
                <div class="row">
                    <div class="alert alert-danger">{{$error}}</div>
                </div>

            @endforeach

        @endif

        {{ Form::open(array('url' => 'dashboard/update-content', 'files' => true)) }}

            {{Form::hidden('id', $row->first()->id)}}
            
            <div class="form-group">
                <div class="row">{{ Form::label('title', 'Title') }}</div>
                <div class="row">{{ Form::textarea('title', $row->first()->title, array('class' => 'form-control', 'id' => 'title')) }}</div>
            </div>
                
            <div class="form-group">
                <div class="row">{{ Form::label('description', 'Description') }}</div>
                <div class="row">{{ Form::textarea('description', $row->first()->description, array('id' => 'editor')) }}</div>
            </div>
                
            <div class="form-group">
                <div class="row">{{ Form::label('page', 'Add to') }}</div>
                <div class="row">
                    <select name="page">
                        <option value="home">Home page</option>
                        <option value="contact">Contact page</option>
                        <option value="slider">Slider</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="row">{{ Form::submit('Submit', array('class' => 'btn btn-primary btn-block')) }}</div>
            </div>
        {{ Form::close() }}

    </div> <!-- /.container -->

    @section ('script')
        {{ HTML::script('redactor/redactor.js') }}
        <script>
        $("#editor").redactor({
          minHeight: 200,
          imageUpload: 'updateContentImage'
        });
        $("#title").redactor();
        </script>
  @stop

@stop
