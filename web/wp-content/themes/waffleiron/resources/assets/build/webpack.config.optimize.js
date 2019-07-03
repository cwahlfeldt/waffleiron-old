"use strict"; // eslint-disable-line

const { default: ImageminPlugin } = require("imagemin-webpack-plugin");
const imageminMozjpeg = require("imagemin-mozjpeg");
const UglifyJsPlugin = require("uglifyjs-webpack-plugin");
const glob = require("glob-all");
const PurgecssPlugin = require("purgecss-webpack-plugin");
//const path = require('path');
const whitelister = require("purgecss-whitelister");

const config = require("./config");

class TailwindExtractor {
  static extract(content) {
    return content.match(/[A-Za-z0-9-_:\/]+/g) || [];
  }
}

module.exports = {
  plugins: [
    new ImageminPlugin({
      optipng: { optimizationLevel: 7 },
      gifsicle: { optimizationLevel: 3 },
      pngquant: { quality: "65-90", speed: 4 },
      svgo: {
        plugins: [
          { removeUnknownsAndDefaults: false },
          { cleanupIDs: false },
          { removeViewBox: false }
        ]
      },
      plugins: [imageminMozjpeg({ quality: 75 })],
      disable: config.enabled.watcher
    }),
    new UglifyJsPlugin({
      uglifyOptions: {
        ecma: 5,
        compress: {
          warnings: true,
          drop_console: true
        }
      }
    }),
    new PurgecssPlugin({
      paths: glob.sync(
        ["resources/views/**/*.blade.php", "resources/assets/js/**/*.js"],
        {
          nodir: true
        }
      ),
      extractors: [
        {
          extractor: class {
            static extract(content) {
              return content.match(/[A-Za-z0-9-_:\/]+/g) || [];
            }
          },
          extensions: ["html", "js", "php"]
        }
      ],
      whitelist: [
        ...whitelister([
          "resources/assets/styles/main.scss",
          "node_modules/tailwindcss/css/preflight.css",
          "resources/assets/styles/common/_global.scss",
          "resources/assets/styles/common/_variables.scss"
        ]),
        "nav",
        "menu-item",
        "sub-menu",
        "menu-item-has-children",
        "mobile-menu",
        "call-to-action-wrap",
        "call-to-action-slide-1",
        "call-to-action-slide-2",
        "call-to-action-slide-3"
      ]
    })
  ]
};
