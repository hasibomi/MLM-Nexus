@extends('admin.layouts.main')

@section('content')

    <div class="container">
       
        <div class="row">
            @if(Session::has('event'))
                {{ Session::get('event') }}
            @endif
        </div>
        
        <div class="col-md-8">
            
            {{ Form::open(array('url' => '/admin/add-slider-post', 'files' => true)) }}
                
                <div class="form-group">
                    <div class="row">
                        {{ Form::hidden('getId') }}
                        {{ Form::label('text', 'Image Text') }}
                        {{ Form::textarea('text', '', ['placeholder' => 'Image text']) }}
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        {{ Form::label('slider1', 'Image 1') }}
                        {{ Form::file('slider1') }}
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        {{ Form::label('slider2', 'Image 2') }}
                        {{ Form::file('slider2') }}
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        {{ Form::label('slider3', 'Image 3') }}
                        {{ Form::file('slider3') }}
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        {{ Form::label('slider4', 'Image 4') }}
                        {{ Form::file('slider4') }}
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        {{ Form::label('slider5', 'Image 5') }}
                        {{ Form::file('slider5') }}
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        {{ Form::label('slider6', 'Image 6') }}
                        {{ Form::file('slider6') }}
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        {{ Form::submit('Add', ['class' => 'btn btn-block btn-success']) }}
                    </div>
                </div>
            
            {{ Form::close() }}
            
        </div>
        
    </div>
    {{-- /.container --}}
    
    @section('script')
        {{ HTML::script('tinymce/tinymce.min.js') }}
        <script>
            tinymce.init({
                selector: "textarea"
            });
        </script>
        
        <script>
            function getId()
            {
                $.ajax({
                    url: '/admin/getId',
                    method: 'GET',
                    dataType: 'HTML',
                    success: function(data) {
                        $("input[name=getId]").val(data);
                    }
                });
            }
            
            $(document).ready(function() {
                getId();
            });
        </script>
            
    @stop

@stop