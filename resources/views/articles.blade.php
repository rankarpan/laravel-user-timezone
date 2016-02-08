@extends('layout.layout')

@section('headlink')
	@include('sections.headlink')
@stop

@section('content')
	<h1>Blog Hello World</h1>
	{{ $timezone }}
	<hr>
	<ol class="list-unstyled">
		@foreach ($articles as $article)
		<li>
			<h3>({{ $article->id }}) {{ $article->title }}</h3>
			<p>{{ $article->body }}</p>
			<time>- {{ $article->user->name }}</time>
		</li>
		@endforeach
	</ol>
	{!! $articles->render() !!}
@stop