@extends('app')

@section ('title', 'Goodler Judge - Queue')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
					<h2>
						Queue.
						<small>Evaluated and solutions waiting in the queue.</small>
					</h2>
				</div>
			</div>

			<table class="table table-hover">
				<thead>
				<tr>
					<th class="text-right">ID</th>
					<th class="text-center">DATE</th>
					<th class="text-center">USER</th>
					<th class="text-center">PROBLEM</th>
					<th class="text-center">RESULT</th>
					<th class="text-right">TIME</th>
					<th class="text-right">MEMORY</th>
				</tr>
				</thead>
				<tbody>
				@foreach ($solutions as $solution)
					@if ($solution->status == "-")
					<tr class="active">
					@elseif ($solution->status == "OK")
					<tr class="success">
					@elseif ($solution->status == "CCE" ||
					         $solution->status == "CE")
					<tr class="warning">
					@else
					<tr class="danger">
					@endif
						<td class="text-right"><a href="{{ action(
								'ProblemSolutionController@show',
								[$solution->problem, $solution]) }}">
							{{ $solution->id }}
						</a></td>
						<td class="text-center">
							{{ $solution->created_at }}
						</td>
						<td class="text-center"><a href="{{ action(
								'UserController@show', $solution->user) }}">
							{{ $solution->user->username }}
						</a></td>
						<td class="text-center">
							<a href="{{ action('ProblemController@show',
								$solution->problem) }}">
								{{ $solution->problem->name }}
						</a></td>
						<td class="text-center">{{ $solution->status }}</td>
						<td class="text-right">{{
							$solution->total_time !== null ?
							sprintf("% 2.2f", $solution->total_time) :
							'-' }}</td>
						<td class="text-right">{{
							$solution->max_memory !== null ?
							sprintf('%3.0f MB', $solution->max_memory / 1024) :
							'-' }}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		{!! $solutions->render() !!}
		</div>
		<!-- end row -->
		@include('partials.footer')
	</div> <!-- end container -->

@stop


