const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");

mix.postCss("resources/css/app.css", "public/css", [
    tailwindcss("./tailwind.config.js"),
]);

mix.options({
    postCss: [require("autoprefixer")],
});

mix.setPublicPath("public");

mix.webpackConfig({
    resolve: {
        extensions: [".js", ".vue"],
        alias: {
            "@": __dirname + "resources",
        },
    },
    output: {
        chunkFilename: "js/chunks/[name].js",
    },
}).react();

mix.js("resources/landing-page/src/index.js", "public/js/app.js").version();
mix.copy("resources/landing-page/public", "public");
