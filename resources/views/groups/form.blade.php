<div class="form-group">
	{!! Form::label('name','Name: ') !!}
	{!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('user_list','Add users: ') !!}
	{!! Form::select('user_list[]',
	                 $users,
	                 null,
	                 ['id' => 'user_list',
	                     'class' => 'form-control',
	                     'multiple'])
	!!}
</div>

<div class="form-group">
	{!! Form::label('problem_list','Add problems: ') !!}
	{!! Form::select('problem_list[]',
	                  $problems,
	                  null,
	                  ['id' => 'problem_list',
	                      'class' => 'form-control',
	                      'multiple'])
	!!}
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' =>
	'btn btn-primary form-control']) !!}
</div>

<script>
	$('#user_list').select2({
		placeholder: "Choose users"
	});
	$('#problem_list').select2({
		placeholder: "Choose problems"
	});
</script>
