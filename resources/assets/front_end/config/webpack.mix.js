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


mix.js('resources/assets/front_end/js/app.js', 'public/js/front_end')
    .sass('resources/assets/front_end/sass/app.scss', 'public/css/front_end');


if (mix.inProduction()) {
    mix.version();
}

// BrowserSync
mix.browserSync({
    proxy: 'blog.localhost',
    port: 3000,
    open: false
});
