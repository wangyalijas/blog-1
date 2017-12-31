let mix = require('laravel-mix');

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


// Front end resources
mix.js('resources/assets/front_end/js/app.js', 'public/js/front_end')
   .sass('resources/assets/front_end/sass/app.scss', 'public/css/front_end');


// Console sources
mix.js('resources/assets/console/js/app.js', 'public/js/console')
    .sass('resources/assets/console/sass/app.scss', 'public/css/console');


// BrowserSync
mix.browserSync({
    proxy: 'blog.localhost',
    port: 3000,
    open: false
});
