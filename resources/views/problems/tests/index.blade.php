@extends('app')

@section ('title')
	Goodler Judge - {{ $problem->name }} Tests
@stop

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
					<h2>
						Tests.
						<small>List of problem tests.</small>
					</h2>
				</div>
			</div>
		</div><!-- end row -->

		<div class="row">
			@if(! $problem->test_cases->isEmpty())
			<div class="panel panel-default">
				<div class="panel-body">
					<table class="table table-hover">
						<thead>
						<tr>
							<th class="col-md-1">ID</th>
							<th class="col-md-4">INPUT FILE</th>
							<th class="col-md-4">OUTPUT FILE</th>
							<th class="col-md-2">CREATED AT</th>
							<th class="col-md-1"></th>
						</tr>
						</thead>
						<tbody>
						@foreach ($problem->test_cases as $test)
							<tr>
								<td class="col-md-1">
									{{ $test->id }}
								</td>
								<td class="col-md-4">
									<a href="/problem/{{ $problem->id }}/
									test/{{ $test->id }}/
									download/1">
										{{ $test->getInputFileAttribute() }}
									</a>
								</td>
								<td class="col-md-4">
									<a href="/problem/{{ $problem->id }}/
									test/{{ $test->id }}/
									download/2">
										{{ $test->getCheckerDataAttribute() }}
									</a>
								</td>
								<td class="col-md-2">
									{{ $test->created_at }}
								</td>
								<td class="col-md-1">
									{!! Form::open(['method'=>'DELETE',
									                'route' =>
									               ['problem.test.destroy',
									                 $problem->id,
									                 $test->id]]) !!}

									{!! Form::submit('Delete',
									['class'=>'btn btn-danger btn-sm'])  !!}

									{!! Form::close() !!}
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
			@else
				<p>No tests cases.</p>
			@endif
		</div>

			@include('partials.footer')

	</div> <!-- end container -->

@stop


