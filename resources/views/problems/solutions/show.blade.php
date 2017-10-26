@extends('app')

@section ('title', 'Goodler Judge | View solution')

@section ('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h2>
					Solution for 
						<a href="{{ action('ProblemController@show',
						                   $problem) }}">
							{{ $problem->name }}</a>
					<small> by
						<a href="{{ action('UserController@show',
						                   $solution->user) }}">
							{{ $solution->user->username }}</a>
					</small>
				</h2>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<pre>{{ $solution->source_code }}</pre>
		</div>
	</div>
	<div class="row">
		<div class="col-md-1">Status:</div>
		<div class="col-md-1">{{ $solution->status }}</div>
	</div>
	<div class="row">
		<div class="col-md-1">Total time:</div>
		<div class="col-md-1">{{ $solution->total_time }}</div>
	</div>
	<div class="row">
		<div class="col-md-1">Memory:</div>
		<div class="col-md-1">{{ $solution->max_memory }}</div>
	</div>
	@include('partials.footer')
</div>

@stop
