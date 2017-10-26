@extends('app')

@section ('title')
	Profile - {{ $user->username }}
@stop

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h2>
					Account
					@if (Auth::check() && Auth::user()->id == $user->id)
					<small>
						<a class="btn btn-primary pull-right" href="/user/{{ $user->id }}/edit">
							Edit
						</a>
					</small>
					@endif
				</h2>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Account informations</h3>
				</div>
				<div class="panel-body">
					<table class="table">
						<tr>
							<td class="col-md-1">Username: </td>
							<td class="col-md-3">{{ $user->username }}
							</td>
						</tr>
						<tr>
							<td class="col-md-1">Joined: </td>
							<td class="col-md-3">{{ $user->created_at }}
							</td>
						</tr>
						<tr>
							<td class="col-md-1">Email: </td>
							<td class="col-md-3">{{ $user->email }}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-7 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Created problems</h3>
				</div>
				<div class="panel-body">
					<table class="table">
						<thead>
						<tr>
							<th class="col-md-2">ID</th>
							<th class="col-md-3">PROBLEM</th>
							<th class="col-md-2 text-center">DATE</th>
						</tr>
						</thead>
						<tbody>
						@foreach ($user->problems as $problem)
							<tr>
								<td class="col-md-2">{{ $problem->id }}
								</td>
								<td class="col-md-3">
									<a href="{{
										action('ProblemController@show',
										$problem) }}">
										{{ $problem->name }}</a>
								</td>
								<td class="col-md-2">
										{{ $problem->created_at }}
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Groups</h3>
				</div>
				<div class="panel-body">
					@foreach ($user->groups as $group)
						<a class="badge" href="{{ action('GroupController@show',
						   $group) }}">
							{{ $group->name }}
						</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Problem's status</h3>
				</div>
				<div class="panel-body">
					<div class="panel panel-default">
						<div class="panel-heading">
							Solved problems
						</div>
						<div class="panel-body">
						<table class="table table-hover">
						<thead>
						<tr>
							<th class="col-md-3">DATE</th>
							<th class="col-md-3">PROBLEM</th>
							<th class="col-md-3">SOLUTION</th>
							<th class="col-md-3">STATUS</th>
						</tr>
						</thead>
						<tbody>
						@foreach ($OKSolutions as $sol)
							<tr class="success">
								<td class="col-md-3">
									{{ $sol->created_at }}
								</td>
								<td class="col-md-3">
									<a href="{{
									  action('ProblemUserSolutionController@index',
									  [$sol->problem, $user])
									  }}">
										{{ $sol->problem->name }}
									</a>
								</td>
								<td class="col-md-3">
									<a href="{{
									  action('ProblemSolutionController@show',
									  [$sol->problem, $sol]) }}">
									{{ $sol->id }}
									</a>
								</td>
								<td class="col-md-3">
									{{ $sol->status }}
								</td>
							</tr>
						@endforeach
						</tbody>
						</table>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							Unsolved problems
						</div>
						<div class="panel-body">
							<table class="table table-hover">
							<thead>
							<tr>
								<th class="col-md-3">DATE</th>
								<th class="col-md-3">PROBLEM</th>
								<th class="col-md-3">SOLUTION</th>
								<th class="col-md-3">STATUS</th>
							</tr>
							</thead>
							<tbody>
							@foreach ($notOKSolutions as $sol)
							@if ($sol->status == "-")
								<tr class="active">
									@elseif ($sol->status == "OK")
								<tr class="success">
									@elseif ($sol->status == "CCE" ||
											 $sol->status == "CE")
								<tr class="warning">
							@else
								<tr class="danger">
							@endif
								<td class="col-md-3">
									{{ $sol->created_at }}
								</td>
								<td class="col-md-3">
									<a href="{{
									  action('ProblemUserSolutionController@index',
									  [$sol->problem, $user, 'unsolved'])}}">
										{{ $sol->problem->name }}
									</a>
								</td>
								<td class="col-md-3">
									<a href="{{
									   action('ProblemSolutionController@show',
									   [$sol->problem, $sol]) }}">
										{{ $sol->id }}
									</a>
								</td>
								<td class="col-md-3">
									{{ $sol->status }}
								</td>
							</tr>
							@endforeach
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	@include('partials.footer')
</div> <!-- end container -->

@stop
