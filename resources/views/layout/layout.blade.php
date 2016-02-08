<!DOCTYPE html>
<html lang="en-US">
	<head>
		@yield('headlink')
		{!! SEO::generate() !!}
	</head>
	<body>
		<div class="container">
			@yield('content')
		</div>
	</body>
</html>