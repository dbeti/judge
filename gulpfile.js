var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {

	mix.sass('app.scss', 'resources/assets/css');

	mix.styles([
		'bootstrap.min.css',
		'bootstrap-theme.min.css',
		'select2.min.css',
		'app.css'
	]);

	mix.scripts([
		'jquery-2.1.4.min.js',
		'bootstrap.min.js',
		'select2.min.js',
	]);

	mix.copy('resources/assets' + '/fonts/**', 'public/build/fonts');

	mix.copy('resources/assets/images/code-wallpaper-4.png',
	         'public/images/code-wallpaper-4.png');

	mix.version('public/css/all.css');
});

