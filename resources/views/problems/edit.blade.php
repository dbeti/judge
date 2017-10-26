@extends('app')

@section ('title', 'Goodler Judge - Edit problem')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
					<h2>
						Edit: {{ $problem->name }}
					</h2>
				</div>
			</div>
		</div><!-- end row -->

		<!-- FORMS -->
		{!! Form::model($problem, ['method' => 'PATCH', 'action' =>
						['ProblemController@update', $problem]]) !!}

		@include ('problems.form', ['submitButtonText' => 'Edit problem'])

		{!! Form::close() !!}

		@include('errors.list')

		@include('partials.footer')
	</div> <!-- end container -->

@stop


