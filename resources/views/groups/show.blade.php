@extends('app')

@section('title')
	Goodler Judge - {{ $group->name }}
@stop

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h2>
					Group {{ $group->name }}'s information.
				</h2>
				@if (Auth::user() && Auth::user()->id == $group->user->id)
				<a href="{{ action('GroupController@edit', $group) }}"
				   class="btn btn-primary pull-right">
					Edit
				</a>
				{!! Form::open(['method' => 'DELETE',
				                'route' => ['group.destroy', $group->id]])
				!!}
				{!! Form::submit('Delete',
				                 ['class' => 'btn btn-danger pull-right'])
				!!}
				{!! Form::close() !!}
				@endif
				<h3>
					Owner: {{ \GoodlerJudge\User::findOrFail
							  ($group->user_id)->username
						   }}
				</h3>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md=12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						Users
					</h3>
				</div>
				<div class="panel-body">
					<ol class="list-group">
					@foreach ($group->users as $user)
					<li class="list-group-item">
						<a href="{{ action('UserController@show',
						            $user->id) }}">
							{{ $user->username }}
						</a>
					</li>
					@endforeach
					</ol>
				</div>
			</div>
		</div>
	</div>
	@if ($group->problems->count() !== 0)
	<div class="row">
		<div class="col-md=12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						Associated problems
					</h3>
				</div>
				<div class="panel-body">
					<ol class="list-group">
					@foreach ($group->problems as $problem)
					<li class="list-group-item">
						<a href="{{ action('ProblemController@show',
						           $problem->id) }}">
							{{ $problem->name }}
						</a>
					</li>
					@endforeach
					</ol>
				</div>
			</div>
		</div>
	</div>
	@endif
	<div class="row">
		@include('partials.footer')
	</div>
</div>

@stop