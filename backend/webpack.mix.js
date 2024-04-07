const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");

mix.postCss("resources/css/app.css", "public/css", [
    tailwindcss("./tailwind.config.js"),
]);

mix.disableSuccessNotifications();
mix.disableNotifications();

mix.options({
    postCss: [require("autoprefixer")],
    processCssUrls: false,
    logs: false,
    clearConsole: true,
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
    module: {
        rules: [
            {
                test: /(\.(png|jpe?g|gif|webp)$|^((?!font).)*\.svg$)/,
                exclude: /node_modules/,
                use: ['file-loader?name=[name].[ext]']
            }
        ]
    },
    stats: {
        warnings: false,
    }

}).react();

// mix.copy("resources/landing-page/public", "public");
// mix.copy("resources/tenant/public", "public");
mix.js("resources/landing-page/src/index.js", "public/js/central.js");
mix.js("resources/tenant/src/index.js", "public/js/tenant.js");


if (mix.inProduction()) {
    mix.version();
}
