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
const js_compile_path = 'public/assets/js';
const css_compile_path = 'public/assets/css';
const fonts_compile_path = 'public/assets/fonts';
const js_resource_path = 'resources/js/';
const css_resource_path = 'resources/css/';
const fonts_resource_path = 'resources/js/';
// mix.js('resources/js/app.js', 'public/js');
// mix.autoload({
//     jquery: ['$', 'jQuery', 'window.jQuery'],
// });
mix.babel([
    js_resource_path + 'vendor/jquery-3.6.0.min.js',
    js_resource_path + 'vendor/jquery-migrate-3.3.2.min.js',
    js_resource_path + 'vendor/modernizr-3.7.1.min.js',
    js_resource_path + 'plugins/jquery-ui.min.js',
    js_resource_path + 'bootstrap.bundle.min.js',
    js_resource_path + 'plugins/plugins.js',
    js_resource_path + 'main.js'
],js_compile_path + '/vendor/libs.js');
// mix.js(js_resource_path + 'vendor/jquery-3.6.0.min.js', js_compile_path + '/vendor');
// mix.js(js_resource_path + 'vendor/jquery-migrate-3.3.2.min.js', js_compile_path + '/vendor');
// mix.js(js_resource_path + 'vendor/modernizr-3.7.1.min.js', js_compile_path + '/vendor');
// mix.js(js_resource_path + 'plugins/jquery-ui.min.js', js_compile_path + '/plugins');
// mix.js(js_resource_path + 'bootstrap.bundle.min.js', js_compile_path);
// mix.js(js_resource_path + 'plugins/plugins.js', js_compile_path + '/plugins');
mix.js(js_resource_path + 'main-map.js', js_compile_path);
mix.js([
    js_resource_path + 'app.js',
    // js_resource_path + 'search.js'
],js_compile_path + '/vendor/app.js');
// mix.js(js_resource_path + 'main.js', js_compile_path);




//
mix.css(css_resource_path + 'bootstrap.min.css',css_compile_path).options({
    processCssUrls: false
});
mix.css(css_resource_path + 'fontawesome.min.css',css_compile_path).options({
    processCssUrls: false
});
mix.css(css_resource_path + 'ionicons.min.css',css_compile_path);
mix.css(css_resource_path + 'simple-line-icons.css',css_compile_path).options({
    processCssUrls: false
});
mix.css(css_resource_path + 'custom.css',css_compile_path).options({
    processCssUrls: false
});
mix.css(css_resource_path + 'style.css',css_compile_path).options({
    processCssUrls: false
});
mix.css(css_resource_path + 'plugins/jquery-ui.min.css',css_compile_path + '/plugins').options({
    processCssUrls: false
});
mix.css(css_resource_path + 'plugins/plugins.css',css_compile_path + '/plugins').options({
    processCssUrls: false
});


