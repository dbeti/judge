@extends('app')

@section ('title', 'Goodler Judge - F.A.Q.')

@section('content')

	<div class="container">
		<div class="page-header">
			<h2>Frequently Asked Questions.
				<small>A little to get you started.</small>
			</h2>
		</div>
		<!-- end page-header -->

		<div class="panel-group" id="accordion-qa">
			@for($i=1; $i<=4; ++$i)
				@include('partials.faqs.' . $i)
			@endfor
		</div>
		@include('partials.footer')
	</div> <!-- end container -->

@stop
