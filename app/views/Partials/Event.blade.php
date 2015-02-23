<div class="row">
    @if(Session::has('event'))
        {{ Session::get('event') }}
    @endif

    @if ($errors->all())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif
</div>