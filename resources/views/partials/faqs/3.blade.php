<div class="panel panel-default">
	<div class="panel-heading" data-toggle="collapse"
		 data-parent="#accordion-qa" href="#qa-{{$i}}">
		<h4 class="panel-title">
			My 100% correct solution has 'WA' status?!
		</h4>
	</div>
	<div class="panel-collapse collapse" id="qa-{{$i}}">
		<div class="panel-body">
			<p>
				Did you strictly follow problem's output instructions? New users
				have this habit of printing unwanted feedback. E.g. if your
				instruction is to print the sum of two numbers on the standard
				output, your output should be that sum, i.e.
				<code>printf("%d", sum)</code> and not
				<code>printf("Sum of two numbers is %d", sum)</code>.
			</p>
		</div>
	</div>
</div>