const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");

mix.postCss("resources/css/app.css", "public/css", [
    tailwindcss("./tailwind.config.js"),
]);

mix.options({
    postCss: [require("autoprefixer")],
    // processCssUrls: false,
    logs: false
});

mix.setPublicPath("public");

mix.webpackConfig({
    resolve: {
        extensions: [".*",".wasm",".mjs",".js",".jsx",".json",".vue"],
        alias: {
            "@": __dirname + "resources",
        },
    },
    output: {
        chunkFilename: "js/chunks/[name].js",
    },
}).react();

mix.js("resources/landing-page/src/index.js", "public/js/central.js");
mix.js("resources/tenant/src/index.js", "public/js/tenant.js");
// mix.copy("resources/landing-page/public", "public");
// mix.copy("resources/tenant/public", "public");

if (mix.inProduction()) {
    mix.version();
}
