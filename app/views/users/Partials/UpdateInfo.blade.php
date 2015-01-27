{{ Form::open(array('url' => 'upload', 'files' => true)) }}
    {{ Form::file('propic') }}
    <br />
    {{ Form::submit('Upload', $attributes = ['class' => 'btn btn-success btn-sm']) }}
{{ Form::close() }}