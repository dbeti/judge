@extends ('app')

@section ('title', 'Goodler Judge | Submit solution')

@section ('content')

<div class="container">
	<div class="row">
		<div class="col-md-12 page-header">
			<h2>Submit solution for {{ $problem->name }}:</h2>
		</div>
	</div>

	<div class="row">
		@foreach ($errors->all() as $error)
			<p>{{ $error }}</p>
		@endforeach
	</div>

	{!! Form::open([
		'action' => ['ProblemSolutionController@store', $problem],
		'method' =>'POST',
		'files' => true,
		'class' => 'form-horizontal'
	]) !!}
		<div class="form-group">
			{!! Form::label('source', 'Source file:',
				['class' => 'col-md-6']) !!}
			<div class="col-md-6">
				{!! Form::file('source')  !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('language', 'Language:',
				['class' => 'col-md-6']) !!}
			<div class="col-md-6">
				{!! Form::select('language', $langs, null,
					['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::submit('Submit solution', [
				'class' => 'form-control btn btn-primary'
			]) !!}
		</div>
	{!! Form::close() !!}
</div>
@stop
