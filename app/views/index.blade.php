@extends('layouts.default')

@section('content')
<div class="well">
	<p>You have arrived.</p>
</div>

<div>
	<p>Results for tag "{{ $tag }}":</p>
	@foreach ($tagResults as $result)
		<div class="media">
			<a class="pull-left" href="{{ $result['url'] }}" target="_blank">
				<img class="media-object" src="/img/{{ strtolower($result['origin']) }}.png" alt="{{ $result['origin'] }}">
			</a>
			<div class="media-body">
				<a href="{{ $result['url'] }}" target="_blank">
					<h4 class="media-heading">{{ $result["title"] }}</h4>
				</a>
				<div class="result-user">{{ $result["user"] }}</div>
				<div class="result-date">{{ date("m/d/Y h:ia", $result["date"]) }}</div>
			</div>
		</div>
	@endforeach
</div>
@stop
