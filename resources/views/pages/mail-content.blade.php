@extends('layout.layout')

@section('headlink')
	<title>Send Mail</title>
	@include('sections.headlink')
@stop

@section('content')
	<hr>
	@if (session('status'))
	    <div class="alert alert-success">
	        {{ session('status') }}
	    </div>
	@endif
	<hr>
	{!! Form::open(['url' => 'auto-mail', 'enctype' => 'multipart/form-data']) !!}
		@include('pages._mail-content-form', ['submit_btn' => 'Send Mail'])
	{!! Form::close() !!}
	<hr>
@stop