@extends('layout.layout')

@section('headlink')
	<title>Identity Card</title>
	@include('sections.headlink')
@stop

@section('content')
	<hr>
	<section id="id-card">
		<img class="img-responsive" scr="images/logo.png" />
		<h2 class="h2">Dalhousie Winter Trekking Expedition</h2>
		<img class="img-responsive user-photo" src="images/photo-350x450.jpg" />
		<h1 class="h1">Arpan Rank</h1>
	</section>
	<hr>
@stop