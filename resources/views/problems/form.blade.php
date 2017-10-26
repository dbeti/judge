<div class="form-group">
	{!! Form::label('name','Name: ') !!}
	{!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('description','Description: ') !!}
	{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{!! Form::label('time_limit','Time limit: ') !!}
			{!! Form::input('number','time_limit', null,
							['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			{!! Form::label('memory_limit','Memory limit: ') !!}
			{!! Form::input('number','memory_limit', null,
							['class' => 'form-control']) !!}
		</div>
	</div>
</div>
<hr>
<!-- File upload -->
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			{!! Form::label('checker_id','Checker:') !!}
			{!! Form::select('checker_id',$checkers, null,
			['class'=> 'form-control']) !!}
		</div>
	</div>
	<div class="col-md-12">
		<a class="btn btn-default form-group"
		   href="/checker">Upload checker</a>
	</div>
</div>

<hr>
<!-- Select tags -->
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			{!! Form::label('tag_list','Tags:') !!}
			{!! Form::select('tag_list[]',$tags, null,
							['class'=> 'form-control', 'multiple',
			                 'id' => 'tag_list']) !!}
		</div>
	</div>
</div>

<!-- Submit button -->
<div class="form-group">
	{!! Form::submit($submitButtonText, [
		'class' => 'btn btn-primary form-control'
	]) !!}
</div>

<script>
	$('#tag_list').select2({
		placeholder: "Select or add tag:name(description)",
		tags: true,
		tokenSeparators: [";"],
		createTag: function(newTag) {
			return {
				id: 'new:' + newTag.term,
				text: newTag.term + ' -(new)'
			};
		}
	});
</script>