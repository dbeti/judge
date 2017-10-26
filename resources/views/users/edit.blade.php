@extends('app')

@section ('title', 'Goodler Judge - Edit account')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
					<h2>
						Edit account.
					</h2>
				</div>
			</div>
		</div><!-- end row -->

		<!-- FORMS -->
		{!! Form::model($user, ['method' => 'PATCH', 'action' =>
		['UserController@update', $user]]) !!}

		<div class="form-group">
			{!! Form::label('name','Name: ') !!}
			{!! Form::text('name', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('username','Username: ') !!}
			{!! Form::text('username', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('email','Email: ') !!}
			{!! Form::email('email', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Edit account', ['class' =>
			'btn btn-primary form-control']) !!}
		</div>

		{!! Form::close() !!}

		@include('errors.list')

		@include('partials.footer')
	</div> <!-- end container -->

@stop


