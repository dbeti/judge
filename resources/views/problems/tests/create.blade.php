@extends ('app')

@section ('title', 'Goodler Judge | Submit test')

@section ('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12 page-header">
				<h2>Submit test for {{ $problem->name }}:</h2>
			</div>
		</div>

		<div class="row">
			@foreach ($errors->all() as $error)
				<p>{{ $error }}</p>
			@endforeach
		</div>

		{!! Form::open([
		'action' => ['ProblemTestController@store', $problem],
		'method' =>'POST',
		'files' => true,
		'class' => 'form-horizontal'
		]) !!}
		<div class="form-group">
			{!! Form::label('test_input', 'Input file:',
			['class' => 'col-md-3']) !!}
			<div class="col-md-9">
				{!! Form::file('test_input')  !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('test_output', 'Output file:',
			['class' => 'col-md-3']) !!}
			<div class="col-md-9">
				{!! Form::file('test_output')  !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::submit('Submit test', [
			'class' => 'form-control btn btn-primary'
			]) !!}
		</div>
		{!! Form::close() !!}
	</div>
@stop