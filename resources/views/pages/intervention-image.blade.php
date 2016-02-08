@extends('layout.layout')

@section('headlink')
	<title>Intervention Image</title>
	@include('sections.headlink')
@stop

@section('content')
	<hr>
	{!! Form::open(['url' => 'intervention-image', 'enctype' => 'multipart/form-data']) !!}
		@include('pages._intervention-image-form', ['submit_btn' => 'Upload Image'])
	{!! Form::close() !!}
	<hr>
@stop