var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
elixir.config.sourcemaps = false;

elixir(function(mix) {
    mix.copy( 'resources/assets/fonts/FontAwesome.otf', 'public/fonts/FontAwesome.otf' )
        .copy( 'resources/assets/fonts/fontawesome-webfont.eot', 'public/fonts/fontawesome-webfont.eot' )
        .copy( 'resources/assets/fonts/fontawesome-webfont.svg', 'public/fonts/fontawesome-webfont.svg' )
        .copy( 'resources/assets/fonts/fontawesome-webfont.ttf', 'public/fonts/fontawesome-webfont.ttf' )
        .copy( 'resources/assets/fonts/fontawesome-webfont.woff', 'public/fonts/fontawesome-webfont.woff' )
        .copy( 'resources/assets/fonts/fontawesome-webfont.woff2', 'public/fonts/fontawesome-webfont.woff2' )
        .less(['app.less'], 'resources/assets/css/custom.min.css')
        .styles([
            'bootstrap.min.css',
            'font-awesome.min.css',
            'select.css',
            'select2-bootstrap-theme.css',
            'custom.min.css'
        ], 'public/css/app.min.css')
        .scriptsIn('resources/assets/js/angular', 'resources/assets/js/angular-scripts.min.js')
        .scriptsIn('resources/assets/js/angular-plugins', 'resources/assets/js/angular-plugins.min.js')
        .scripts([
            'jquery.min.js',
            'bootstrap.min.js',
            'angular.js',
            'angular-plugins.min.js',
            'angular-scripts.min.js',
            'laravel-crud.js',
            'custom.js'
        ], 'public/js/app.min.js')
        .version(['public/css/app.min.css', 'public/js/app.min.js'])
        .browserSync({
            proxy: 'http://programplanner.app/',
            port: 8080,
        });
});