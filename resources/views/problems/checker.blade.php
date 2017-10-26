@extends ('app')

@section ('title', 'Goodler Judge - Create checker')

@section ('content')

	{!! Form::open(array('action' => 'CheckerController@store',
	'files' => true)) !!}

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
					<h2>
						Create new checker.
					</h2>
				</div>
			</div>
		</div><!-- end row -->

		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					{!! Form::label('file','Checker:') !!}
					{!! Form::file('file',['class'=>'form-control']) !!}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					{!! Form::label('name','Checker name:') !!}
					{!! Form::text('name', null, ['class'=>'form-control']) !!}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					{!! Form::label('prog_lang','ProgLang:') !!}
					{!! Form::select('prog_lang',$programLang, null,
					['class'=> 'form-control']) !!}
				</div>
			</div>
		</div>

		<!-- Submit button -->
		<div class="form-group">
			{!! Form::submit("Create Checker", [
			'class' => 'btn btn-primary form-control'
			]) !!}
		</div>

		{!! Form::close() !!}

		@include('errors.list')

		@include('partials.footer')
	</div> <!-- end container -->

@stop


