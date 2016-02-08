<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link rel="stylesheet" href="/css/bootstrap.min.css" />

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="/css/bootstrap-datetimepicker.min.css" />
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Laravel</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Home</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<script src="/js/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/moment.min.js"></script>
	<script src="/js/jquery.ajaxlibs.js"></script>
	<script src="/js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript">
		$(function () {
			var dateNow = new Date();
            $('#datetimepicker').datetimepicker({
            	defaultDate: dateNow,
            	format: 'YYYY-MM-DD HH:mm:ss',
                sideBySide: true
            });
        });

        $(function () {
        	$('#dateTimeForm').ajaxForm({
        		onSuccess:function(data){
        			console.log(data);
        		}
        	});
        });
	</script>
	<!--script src="/js/jstz.min.js"></script>

	<script type="text/javascript">
		var tz = jstz.determine();
		var tzname = 'UTC';

		if (typeof (tz) === 'undefined') {
			tzname = 'UTC';
		}
		else {
			tzname = tz.name();
		}

		console.log(tzname);

		$.ajax({
			type: "GET",
			url: "{{ URL::to('guesttzdetect') }}",
			data: {'tz_guest': tzname},
			success: function(data)
			{
				console.log(data);
			}
		});
		//window.location.href = "auth/login?tz_guest="+tzname;
	</script-->
</body>
</html>
