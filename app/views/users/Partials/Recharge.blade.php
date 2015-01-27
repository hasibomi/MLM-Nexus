{{ Form::open(array('url' => 'account/recharge')) }}
    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2">
                <label>Type the card number</label>
            </div>
        </div>
        <div class="row">
            <div class="row col-md-8 col-md-offset-2">
                {{ Form::text('code', $value = null, $attributes = ['placeholder' => 'Type here', 'class' => 'form-control']) }}
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-8">
            <div class="row">
                {{ Form::submit('Recharge', $attributes = ['class' => 'btn btn-success btn-md btn-block']) }}
            </div>
        </div>
    </div>
{{ Form::close() }}