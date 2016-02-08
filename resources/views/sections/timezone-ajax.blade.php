<strong>Local Time (Guest) :</strong> {{ $timezone }}</br>
@if(isset($session))
	<strong>Session</strong> : {{ $session }}</br>
@endif
<strong>UTC Time (Universal) :</strong> {{ $timezone_utc }}</br>