@extends('layout.layout')

@section('headlink')
	<title>Expiry URL Generation</title>
	@include('sections.headlink')
@stop

@section('content')
	<hr>
	<a href="">
		<img class="img-responsive" src="banner.jpg" />
	</a>
	<hr>
	{!! Form::open(['url' => 'expiry-url']) !!}
		@include('pages._expiry-url-form', ['submit_btn' => 'Generate Expiry Url'])
	{!! Form::close() !!}
	<hr>
	<div id="fb-root"></div><script>(function(d, s, id) {  var js, fjs = d.getElementsByTagName(s)[0];  if (d.getElementById(id)) return;  js = d.createElement(s); js.id = id;  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";  fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script><div class="fb-post" data-href="https://www.facebook.com/theinvinciblengo/posts/1673891109495759:0" data-width="500"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/theinvinciblengo/posts/1673891109495759:0"><p>We are excited to announce that we are giving away cool Invincible T-shirts.Want one? All you have to do is to share...</p>Posted by <a href="https://www.facebook.com/theinvinciblengo/">Invincible</a> on&nbsp;<a href="https://www.facebook.com/theinvinciblengo/posts/1673891109495759:0">Friday, November 20, 2015</a></blockquote></div></div>
@stop