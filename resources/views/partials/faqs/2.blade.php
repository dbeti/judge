<div class="panel panel-default">
	<div class="panel-heading" data-toggle="collapse"
		 data-parent="#accordion-qa" href="#qa-{{$i}}">
		<h4 class="panel-title">
			Status legend
		</h4>
	</div>
	<div class="panel-collapse collapse" id="qa-{{$i}}">
		<div class="panel-body">
			<p>Your solutions may have following statuses:</p>
			<ul>
				<li>
					 '-' : your solution has not yet been assessed.
				</li>
				<li>
					'OK' : your solution ran successfully and gave correct
				    answer.
				</li>
				<li>
					'WA' : your solution ran successfully but gave an incorrect
					answer.
				</li>
				<li>
					'TLE' : your program was compiled successfully, but it
					didn't stop before time limit.This may be because the
					algorithm is badly designed (too slow), or because it
					contains a bug.
				</li>
				<li>
					'MLE' : your program was compiled successfully, but it
					exceeds memory limit.
				</li>
				<li>
					'CE' : your program couldn't be compiled.
				</li>
				<li>
					'CCE' : something is wrong with the checker, almost never
					not your fault.
				</li>
			</ul>
		</div>
	</div>
</div>