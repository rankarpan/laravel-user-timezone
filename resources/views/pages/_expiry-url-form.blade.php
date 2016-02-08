<div class="row">
	<div class="col-md-8">
		<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
			{!! Form::label('title', 'Title:') !!}
			{!! Form::text('title', null, ['class' => 'form-control'])!!}
			{!! $errors->first('title', '<span class="help-block">:message</span>') !!}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('duration') ? 'has-error' : '' }}">
			{!! Form::label('duration', 'Duration [In Minutes]:') !!}
			{!! Form::text('duration', null, ['class' => 'form-control'])!!}
			{!! $errors->first('duration', '<span class="help-block">:message</span>') !!}
		</div>
	</div>
</div>

<div class="form-group">
	{!! Form::submit($submit_btn, ['class' => 'btn btn-default'])!!}
</div>