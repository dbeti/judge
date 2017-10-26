<!DOCTYPE html>

<html lang="{{ env('APP_LOCALE', 'en') }}">
<head>
	<meta charset="UTF-8">
	<title> @yield ('title') </title>
	<link rel="stylesheet" href="{{ elixir('css/all.css') }}">
</head>
<body>
<script src="/js/all.js"></script>

@include ('partials.nav')

@yield('content')

</body>
</html>
