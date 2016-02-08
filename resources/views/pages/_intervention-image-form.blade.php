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
		<div class="form-group {{ $errors->has('sha_image') ? 'has-error' : '' }}">
			{!! Form::label('sha_image', 'Upload Image:') !!}
			{!! Form::input('file', 'sha_image', null, ['class' => 'form-control'])!!}
			{!! $errors->first('sha_image', '<span class="help-block">:message</span>') !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
			{!! Form::label('image', 'Upload Image:') !!}
			{!! Form::input('file', 'image', null, ['class' => 'form-control'])!!}
			{!! $errors->first('image', '<span class="help-block">:message</span>') !!}
		</div>
	</div>
</div>

<div class="form-group">
	{!! Form::submit($submit_btn, ['class' => 'btn btn-default'])!!}
</div>