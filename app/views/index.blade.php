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

<div>
	<p>Sample Google+ response:</p>
	<pre>
		<?php echo var_dump($googleplus) ?>
	</pre>
</div>

<div>
	<p>Sample GitHub response:</p>
	<pre>
		<?php echo var_dump($github) ?>
	</pre>
</div>
@stop