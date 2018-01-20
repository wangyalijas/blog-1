let mix = require('laravel-mix');

require('../../common/config/webpack.mix');

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


mix.js('resources/assets/console/js/app.js', 'public/js/console')
    .copy('resources/assets/console/js/extras/charts-home.js', 'public/js/console')
    .sass('resources/assets/console/sass/app.scss', 'public/css/console')
    .extract(['lodash', 'jquery', 'bootstrap', 'axios', 'vue', 'popper.js', 'chart.js', 'jquery-validation'])
    .autoload({
        'jquery': ['$', 'window.jQuery'],
        'popper.js': ['Popper', 'window.Popper'],
    });


if (mix.inProduction()) {
    mix.version();
} else {
    mix.sourceMaps();
}


// BrowserSync
mix.browserSync({
    proxy: 'blog.localhost',
    port: 3000,
    open: false
});
