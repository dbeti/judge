@extends('app')

@section ('title', 'Goodler Judge - Contact us')

@section('content')

	<div class="container">
		<div class="page-header">
			<h2>
				Contact Us.
				<small>Let's get in touch.</small>
			</h2>
		</div>
		<div class="row">

			<!-- Informations -->
			<div class="col-lg-4">
				<p>
					To send us a message, use the contact form or the
					information below.
				</p>
				<address>
					<strong>Goodler Judge</strong><br>
					Bag End, at the end of Bagshot Row<br>
					Hobbiton
				</address>
			</div>

			<!-- Form -->
			<div class="col-lg-8">
				{!! Form::open(array('action' => 'ContactController@store',
				                     'class' => 'form-horizontal',
				                     'role' => 'form')) !!}
					<div class="form-group">
						{!! Form::label('name', 'Name',
						                array('class' => 'col-lg-2
						                control-label')) !!}
						<div class="col-lg-10">
							{!! Form::text('name',null,array('required',
							               'class'=>'form-control','id'=>
							               'contact-name','placeholder'=>
							               'Name', 'type'=>'text')) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('email', 'Email address', array('class'
						                 => 'col-lg-2 control-label')) !!}
						<div class="col-lg-10">
							{!! Form::email('email',null,array('required',
							                'class'=>'form-control','id'=>
							                'contact-email','placeholder'=>
							                'Your email address')) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('web', 'Website', array('class' =>
						                'col-lg-2 control-label')) !!}
						<div class="col-lg-10">
							{!! Form::text('web',null,array('required','class'=>
							              'form-control','id'=>'contact-web',
							              'placeholder'=>'URL')) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('message', 'Message', array('class' =>
						                'col-lg-2 control-label')) !!}
						<div class="col-lg-10">
							{!! Form::textarea('message',null,array('required',
							                   'class'=>'form-control','id'=>
							                   'contact-message','placeholder'=>
							                   'Message','cols'=>'30','rows'=>
							                   '10')) !!}
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-10 col-lg-offset-2">
							{!! Form::submit('Send Message',array('class'=>
							                 'btn btn-primary')) !!}
						</div>
					</div>

				{!! Form::close() !!}
				<!-- end form -->
			</div>
			<!-- end col -->
		</div>
		@include('errors.list')
		@if(Session::has('message'))
			<div class="alert alert-info">
				{{Session::get('message')}}
			</div>
			@endif
		<!-- end row -->
		@include('partials.footer')
	</div> <!-- end container -->

@stop


