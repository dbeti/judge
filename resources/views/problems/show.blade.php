@extends('app')

@section ('title')
	Goodler Judge - {{ $problem->name }}
@stop

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
					<h2>
						{{ $problem->name }}.
						@if (Auth::check())
							@if (Auth::user()->id == $problem->user->id)
								<a href="{{ action('ProblemController@edit',
								                    $problem) }}"
								   class="btn btn-primary navbar-btn
								          pull-right">
									Edit
								</a>
							<span class="pull-right">
								{!! Form::open(['method'=>'DELETE', 'action' =>
								['ProblemController@update', $problem]]) !!}

								{!! Form::submit('Delete',
								          ['class'=>'btn btn-danger
								                     navbar-btn'])  !!}

								{!! Form::close() !!}
							</span>
							@endif
						@endif
					</h2>
				</div>
			</div>
		</div>
			<!-- TAGS -->
			@unless ($problem->tags->isEmpty())
			<div class="col-md-12">
				<h4>
					Tags:
				</h4>
				<ul>
					@foreach ($problem->tags as $tag)
						<li>{{ $tag->name }}</li>
					@endforeach
				</ul>
			</div>
			@endunless

			<pre>{{ $problem->description }}</pre>

			<div class="row">
				@if (Auth::check())
				<div class="col-md-2 col-md-offset-2">
					<a href="{{ action('ProblemSolutionController@index',
					                   $problem) }}"
					   class="btn btn-primary">
						View solutions.
					</a>
				</div>
				@endif
				<div class="row">
					@if (Auth::check())
					<div class="col-md-2">
						<a href="{{ action('ProblemSolutionController@create',
					                   $problem) }}"
						   class="btn btn-primary">
							Send solution!
						</a>
					</div>
					@endif
					@if (Auth::check() && Auth::user()->id == $problem->user->id)
					<div class="col-md-2">
							<a href="{{ action('ProblemTestController@create',
										   $problem) }}"
							   class="btn btn-primary">
								Upload tests!
							</a>
					</div>
					@unless($problem->test_cases->isEmpty())
					<div class="col-md-2">
						<a href="{{ action('ProblemTestController@index',
										   $problem) }}"
						   class="btn btn-default">
							Show tests!
						</a>
					</div>
					@endunless
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<p>Author: {{ $problem->user->username }}</p>
					<p>Date: {{ $problem->created_at }}</p>
					<p>Time limit: {{ $problem->time_limit }}</p>
					<p>Memory limit: {{ $problem->memory_limit }}</p>
				</div>
			</div>
		<!-- Messages -->
		@if(Session::has('message'))
			<div class="alert alert-info">
				{{Session::get('message')}}
			</div>
		@endif
		@include('partials.footer')
	</div> <!-- end container -->

@stop
