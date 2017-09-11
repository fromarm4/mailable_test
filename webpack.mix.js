const { mix } = require('laravel-mix');

var bootstrap = require('bootstrap-styl');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
   // .sass('resources/assets/sass/app.scss', 'public/css');
   .stylus('resources/assets/stylus/app.styl', 'public/css', {
        use: [
            require('rupture')(),
            bootstrap()
        ]
    })
   .options({
    postCss: [
            require('postcss-css-variables')()
        ],
    processCssUrls: false
   });