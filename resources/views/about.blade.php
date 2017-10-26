@extends('app')

@section ('title', 'Goodler Judge - About Us')

@section('content')

	<div class="container">
		<div class="page-header">
			<h2>
				About Us.
				<small>Something about our Judge.</small>
			</h2>
		</div>

		<div class="row">
			<div class="col-md-12">
				<p>
					We are self-proclaimed Trio Fantastikus team of The Three
					Musketeers. Our names, written in the Book of Life,
					are Domagoj Beti, Goran Flegar and
					Goran Gosarić.
				</p>
				<p>
					Goodler Judge is created as a project assignement for the
					course Computer Lab 2 which is thought at
					<a href="https://www.math.pmf.unizg.hr/en">PMF</a>.
				</p>
			</div>
		</div>
	</div>
@include('partials.footer')
@stop