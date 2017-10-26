@extends('app')

@section ('title', 'Goodler Judge - Create problem')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
					<h2>
						Create new problem.
					</h2>
				</div>
			</div>
		</div><!-- end row -->

		<!-- FORMS -->
		{!! Form::open(array('action' => 'ProblemController@store',
		                     'files' => true)) !!}

		@include ('problems.form', ['submitButtonText' => 'Add problem'])

		{!! Form::close() !!}

		@include('errors.list')

		@include('partials.footer')
	</div> <!-- end container -->

@stop


