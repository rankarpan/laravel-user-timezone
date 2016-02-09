<div class="weather-widget">

	<div class="row">
		<div class="col-md-4 col-sm-4">
			<h3>{{ $current['name'].', '.$current['sys']['country'] }}</h3>
			<div class="temp">
				<span class="degrees">{{ ceil($current['main']['temp']) }}&deg;</span>
			</div>
			<h4>{{ $current['weather'][0]['description'] }}</h4>
		</div>
		<div class="col-md-8 col-sm-8">
			<div class="details">
				{{ Lang::get("Humidity") }}: <em class="pull-right">{{ ceil( $current['main']['humidity'] ) }}%</em><br>
				{{ Lang::get("Clouds") }}: <em class="pull-right">{{ ceil($current['clouds']['all']) }}%</em><br>
				{{ Lang::get("Wind") }}: <small>({{ OpenWeatherMap::getWindDirection($current['wind']['deg']) }})</small>: <em class="pull-right">{!! $units == 'metric' ? ceil($current['wind']['speed'] * 3.6).'<small>kph</small>' : ceil($current['wind']['speed'] * 3.6 / 1.609344).'<small>mph</small>' !!}</em><br>
			</div>
		</div>
	</div>

	@if($forecast['cnt'] > 1)
	<div class="row">
		<div class="col-md-6 col-sm-6">
			<table class="table table-striped">
				<tr>
					<th>Date</th>
					<th class="text-center">Weather Icon</th>
					<th class="text-center">Day</th>
					<th class="text-center">Night</th>
				</tr>
				@foreach($forecast['list'] as $key => $value)
				@if($key < 7)
				<tr>
					<td><?php $date = date_create(); date_timestamp_set($date, $value['dt']); echo date_format($date, 'jS M (D)'); ?></td>
					<td class="text-center"><i data-icon="{{ OpenWeatherMap::getIcon($value['weather'][0]['id']) }}"></i></td>
					<td class="text-center">{{ ceil($value['temp']['day']) }}&deg;</td>
					<td class="text-center" style="opacity: 0.65;">{{ ceil($value['temp']['night']) }}&deg;</td>
				</tr>
				@endif
				@endforeach
			</table>
		</div>
		<div class="col-md-6 col-sm-6">
			<table class="table table-striped">
				<tr>
					<th>Date</th>
					<th class="text-center">Weather Icon</th>
					<th class="text-center">Day</th>
					<th class="text-center">Night</th>
				</tr>
				@foreach($forecast['list'] as $key => $value)
				@if($key > 6)
				<tr>
					<td><?php $date = date_create(); date_timestamp_set($date, $value['dt']); echo date_format($date, 'jS M (D)'); ?></td>
					<td class="text-center"><i data-icon="{{ OpenWeatherMap::getIcon($value['weather'][0]['id']) }}"></i></td>
					<td class="text-center">{{ ceil($value['temp']['day']) }}&deg;</td>
					<td class="text-center" style="opacity: 0.65;">{{ ceil($value['temp']['night']) }}&deg;</td>
				</tr>
				@endif
				@endforeach
			</table>
		</div>
	</div>
	@endif

</div>