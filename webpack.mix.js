const mix = require("laravel-mix");
const path = require("path");
// Rezolve Ziggy
mix.alias({
    ziggy: path.resolve("vendor/tightenco/ziggy/dist/vue"),
});
mix.js('resources/js/app.js', 'public/js')
    .vue({version: 3})
    .webpackConfig({
        resolve: {
            alias: {
                "@": path.resolve(__dirname, "resources/js"),
            },
        },
    })
    .extract()
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .version();
mix.copy('resources/image', 'public/image');
