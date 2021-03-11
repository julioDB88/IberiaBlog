const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ]);
    mix.copy('node_modules/tinymce/tinymce.min.js', 'public/js/tinymce');
    mix.copy('node_modules/tinymce/themes', 'public/js/tinymce/themes');
    mix.copy('node_modules/tinymce/skins', 'public/js/tinymce/skins');
    mix.copy('node_modules/tinymce/plugins', 'public/js/tinymce/plugins');
    mix.copy('node_modules/tinymce/icons', 'public/js/tinymce/icons');
    mix.copy('node_modules/@fortawesome/fontawesome-free/css/all.css','public/css/fontawesome')
    mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts','public/css/webfonts')
    .options({ processCssUrls: false })
if (mix.inProduction()) {
    mix.version();
}
