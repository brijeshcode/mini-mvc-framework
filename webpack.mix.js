let mix = require('laravel-mix');
require('laravel-mix-purgecss');

mix
    .js('app/Assets/js/app.js', 'public/js/script.js')
    .css('app/Assets/css/app.css', 'public/css')
    .vue()
    .purgeCss({
        enabled: true,
    });