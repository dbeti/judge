@extends('app')

@section ('title', 'Goodler Judge - Edit group')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h2>
					Edit group {{ $group->name }}
				</h2>
			</div>
		</div>
	</div><!-- end row -->

	<!-- FORMS -->
	{!! Form::model($group, ['method' => 'PATCH', 'action' =>
	['GroupController@update', $group]]) !!}

	@include('groups.form', ['submitButtonText' => 'Update group'])

	{!! Form::close() !!}

	@include('errors.list')

	@include('partials.footer')
</div> <!-- end container -->

@stop