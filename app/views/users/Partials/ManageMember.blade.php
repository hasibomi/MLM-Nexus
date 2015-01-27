<div class="col-md-6">
    <div class="panel panel-success">
        <div class="panel-heading">
            LEFT HAND SIDE
        </div>
        <div class="panel-body">
            @if ($left_member->count() == 0)
                <p>No member(s) found</p>
            @else
                @foreach ($left_member as $left_side)
                    <p>{{ $left_side->name }}</p>
                @endforeach
            @endif
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="panel panel-success">
        <div class="panel-heading">
            RIGHT HAND SIDE
        </div>
        <div class="panel-body">
            @if ($right_member->count() == 0)
                <p>No member(s) found</p>
            @else
                @foreach ($right_member as $right_side)
                    <p>{{ $right_side->name }}</p>
                @endforeach
            @endif
        </div>
    </div>
</div>