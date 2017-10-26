@extends('app')

@section ('title', 'Goodler Judge - Create group')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h2>
					Create new group.
				</h2>
			</div>
		</div>
	</div><!-- end row -->

	<!-- FORMS -->
	{!! Form::open(array('action' => 'GroupController@store')) !!}

	@include ('groups.form', ['submitButtonText' => 'Add Group'])

	{!! Form::close() !!}


	@include('errors.list')

	@include('partials.footer')
</div> <!-- end container -->
@stop