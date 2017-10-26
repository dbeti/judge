@extends('app')

@section ('title', 'Goodler Judge - Users')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h2>
					Users.
					<small>List of our users.</small>
				</h2>
			</div>
		</div>
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-body">
					<table class="table table-hover">
						<thead>
						<tr>
							<th class="col-md-1">USERNAME</th>
							<th class="col-md-2">JOINED</th>
						</tr>
						</thead>
						<tbody>
						@foreach($users as $usr)
							<tr>
								<td class="col-md-1">
									<a href = "{{ action('UserController@show',
									              $usr->id) }}">
										{{ $usr->username }}
									</a>
								</td>
								<td class="col-md-2">
									{{ $usr->created_at }}
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
					{!! $users->render() !!}
					</div>
				</div>
		</div><!-- end row -->
		@include('partials.footer')
	</div> <!-- end container -->

@stop


