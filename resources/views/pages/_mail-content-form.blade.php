<div class="row">
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
			{!! Form::label('name', 'Full Name:') !!}
			{!! Form::text('name', null, ['class' => 'form-control'])!!}
			{!! $errors->first('name', '<span class="help-block">:message</span>') !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
			{!! Form::label('email', 'Email:') !!}
			{!! Form::input('email', 'email', null, ['class' => 'form-control'])!!}
			{!! $errors->first('email', '<span class="help-block">:message</span>') !!}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-8">
		<div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
			{!! Form::label('subject', 'Mail Subject:') !!}
			{!! Form::text('subject', null, ['class' => 'form-control'])!!}
			{!! $errors->first('subject', '<span class="help-block">:message</span>') !!}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-8">
		<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
			{!! Form::label('content', 'Mail Content:') !!}
			{!! Form::textarea('content', null, ['class' => 'form-control'])!!}
			{!! $errors->first('content', '<span class="help-block">:message</span>') !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('filename') ? 'has-error' : '' }}">
			{!! Form::label('filename', 'File Name:') !!}
			{!! Form::text('filename', null, ['class' => 'form-control'])!!}
			{!! $errors->first('filename', '<span class="help-block">:message</span>') !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('attachment') ? 'has-error' : '' }}">
			{!! Form::label('attachment', 'Attachment:') !!}
			{!! Form::input('file', 'attachment', null, ['class' => 'form-control'])!!}
			{!! $errors->first('attachment', '<span class="help-block">:message</span>') !!}
		</div>
	</div>
</div>

<div class="form-group">
	{!! Form::submit($submit_btn, ['class' => 'btn btn-default'])!!}
</div>