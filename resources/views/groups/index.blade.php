@extends('app')

@stop

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h2>
					Groups.
					<small>List of groups.</small>
					@if(Auth::check())
					<small>
						<a href="{{ action('GroupController@create') }}">
							Create new.
						</a>
					</small>
					@endif
				</h2>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-body">
				<table class="table table-hover">
					<thead>
					<tr>
						<th class="col-md-6">GROUP</th>
						<th class="col-md-4">OWNER</th>
					</tr>
					</thead>
					<tbody>
					@foreach($groups as $group)
						<tr>
							<td class="col-md-6">
								<a href="{{
									action('GroupController@show', $group->id)
								}}">
									{{ $group->name }}
								</a>
							</td>
							<td class="col-md-4">
								{{ $group->user->username }}
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		@include('partials.footer')
	</div>
</div>

@stop

