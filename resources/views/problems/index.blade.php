@extends('app')

@section ('title', 'Goodler Judge - Problems')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
					<h2>
						Problems.
						<small>List of available problems.</small>

						<!-- Only registered user can create problem -->
						@if(Auth::check())
						<small>
							<a href="{{ action('ProblemController@create') }}">
								Create new.
							</a>
						</small>
						@endif
					</h2>
				</div>
			</div>
		</div><!-- end row -->

			<div class="row">
				<div class="panel panel-default">
					<div class="panel-body">
					<table class="table table-hover">
						<thead>
						<tr>
							<th class="col-md-6">PROBLEM</th>
							<th class="col-md-4">AUTHOR</th>
							<th class="col-md-2">CREATED AT</th>
						</tr>
						</thead>
						<tbody>
						@foreach ($problems as $prob)
							<tr>
								<td class="col-md-6">
									<a href="{{
										action('ProblemController@show', $prob)
									}}">
										{{ $prob->name }}
									</a>
								</td>
								<td class="col-md-4">
									<a href="{{ action('UserController@show',
									            $prob->user->id) }}">
									{{ $prob->user->username }}
									</a>
								</td>
								<td class="col-md-2">
									{{ $prob->created_at }}
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
						{{ $problems->render() }}
					</div>
				</div>
			</div>
			<div class="row">
				@include('partials.footer')
			</div>
	</div> <!-- end container -->

@stop


