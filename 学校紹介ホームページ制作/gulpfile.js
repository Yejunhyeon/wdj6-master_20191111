const elixir = require("laravel-elixir");

require("laravel-elixir-vue");
require('laravel-elixir-webpack-official');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp s
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.aa
 |
 */

elixir(mix => {
    mix.sass("app.scss");

    mix.webpack("app.js");

    mix.scripts(
        [
            "../../../node_modules/highlightjs/highlight.pack.js",
            "../../../public/js/app.js",
        ],
        "public/js/app.js"
    );

    mix.version(["css/app.css", "js/app.js"]);


    mix.copy('node_modules/font-awesome/fonts', 'public/build/fonts');

    // mix.browserSync({proxy: 'localhost:8000'});
});