@extends('app')

@section ('title')
	Goodler Judge - {{ $test->id }} Tests
@stop

@section('content')

	<div class="container">
		Problem: {{ $problem->id }}
		{!! Form::open(['method'=>'DELETE', 'route' =>
		['problem.test.destroy', $problem->id, $test->id]]) !!}

		{!! Form::submit('Delete',
		['class'=>'btn btn-danger
		navbar-btn'])  !!}

		{!! Form::close() !!}

		@include('partials.footer')

	</div> <!-- end container -->

@stop


