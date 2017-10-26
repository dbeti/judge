@extends ('app')

@section ('title', 'Goodler Judge')

	@include ('partials.banner')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="page-header">
					<h2>
						Problems.
						<small>Here are most recent problems.</small>
					</h2>
				</div>
				<!-- Left column News -->
					<div class="list-group">
						@foreach($problems as $problem)
							<a class="list-group-item"
							   href="{{ action('ProblemController@show',
							            $problem) }}">
								{{ $problem->name }}
							</a>
						@endforeach
					</div>
			</div>
			<div class="col-md-6">
				<div class="page-header">
					<h2>
						New users.
						<small>Recently joined users.</small>
					</h2>
				</div>
				<!-- Right column Best -->
					<div class="list-group">
						@foreach($users as $user)
							<a class="list-group-item"
							   href="{{ action('UserController@show',
							            $user) }}">
								{{ $user->username }}
							</a>
						@endforeach
					</div>
			</div>
		</div>
		<!-- end row -->
		@include('partials.footer')
	</div> <!-- end container -->

@stop


