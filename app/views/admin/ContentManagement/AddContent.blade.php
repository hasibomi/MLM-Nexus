@extends ('admin.layouts.main')

@section('content')
    
    <div class="container">
        
        {{ Form::open(array('url' => '/admin/storeContent', 'files' => true)) }}
            
            <div class="form-group">
                <div class="row">{{ Form::label('title', 'Title') }}</div>
                <div class="row">{{ Form::text('title', '', array('class' => 'form-control')) }}</div>
            </div>
                
            <div class="form-group">
                <div class="row">{{ Form::label('description', 'Description') }}</div>
                <div class="row">{{ Form::textarea('description') }}</div>
            </div>
                
            <div class="form-group">
                <div class="row">{{ Form::label('home', 'Add to') }}</div>
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
        
    </div>
    <!-- /.container -->
    
    @section ('script')
        {{ HTML::script('tinymce/tinymce.min.js') }}
        <script>
            tinymce.init({
                selector: "textarea"
            });
        </script>
    @stop
    
@stop