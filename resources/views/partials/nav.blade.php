<!-- NAVBAR -->
<nav class="navbar navbar-inverse navbar-fixed-top" id="main-navbar"
	 role="navigation">
	<div class="container">
		<!-- NAVBAR HEADER -->
		<div class="navbar-header">
			<!-- Small nav-thumb, resize -->
			<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target="#navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<!-- Left Navbar Logo -->
			<a class="navbar-brand" href="{{
			action('HomePageController@index') }}">
				Goodler Judge
			</a>
		</div>
		<!-- end navbar-header -->

		<!-- Navigation -->
		<div class="collapse navbar-collapse" id="navbar-collapse">

			@if(Auth::check()) <!-- User is logged -->
				<div class="navbar-text navbar-right">
						<div class="dropdown">
							{{ Auth::user()->username }}
						<a href="#" class="dropdown-toggle"
						   data-toggle="dropdown" role="button"
						   aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-user white-user">
							</span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/user/{{ Auth::user()->id }}">
									Account<span class="glyphicon glyphicon-cog
									             gly-right">
									</span>
								</a>
							</li>
							<li role="separator" class="divider"></li>
							<li>
								<a href="{{
								action('Auth\AuthController@getLogout')
								}}">
									Logout
									<span class="glyphicon glyphicon-log-out
									             gly-right">
									</span>
								</a>
							</li>
						</ul>
						</div>
				</div>
			@else <!-- Guest -->
			<div class="btn-group navbar-right navbar-btn">
				<a class="btn btn-sm btn-primary"
				   href="{{ action('Auth\AuthController@getRegister') }}">
					Register!
				</a>
				<a class="btn btn-sm btn-default"
				   href="{{ action('Auth\AuthController@getLogin') }}">
					Login
				</a>
			</div>
			@endif


			<ul class="nav navbar-nav">
				<li><a href="{{ action('ProblemController@index') }}">
						Problems
					</a></li>
				<li><a href="{{ action('GroupController@index') }}">
						Groups
					</a></li>
				<li><a href="{{ action('QueueController@index') }}">
						Queue
					</a></li>
				<li><a href="{{ action('FaqController@index') }}">
						F.A.Q
					</a></li>
				<li><a href="{{ action('ContactController@index') }}">
						Contact
					</a></li>
				<li><a href="{{ action('AboutController@index') }}">
						About
					</a></li>
			</ul>
		</div>
		<!-- end navigation -->
	</div>
	<!-- end container -->
</nav>
