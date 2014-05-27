@extends('layouts.default')

@section('content')
<div class="well">
	<p>You have arrived.</p>
</div>

<div>
	<p>Sample StackOverflow response:</p>
	<pre>
		<?php echo var_dump($stackoverflow) ?>
	</pre>
</div>
@stop