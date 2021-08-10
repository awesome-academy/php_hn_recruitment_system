const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

mix.postCss('resources/css/main.css', 'public/css');
mix.postCss('resources/css/intro.css', 'public/css');
mix.postCss('resources/css/style_cv.css', 'public/css');
mix.js('resources/js/main.js', 'public/js');
mix.js('resources/js/my_cv.js', 'public/js');
mix.js('resources/js/create_summernote.js', 'public/js');
mix.js('resources/js/upload.js', 'public/js');
