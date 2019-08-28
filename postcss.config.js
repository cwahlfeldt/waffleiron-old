module.exports = {
  plugins: [
    require('postcss-import')({}),
    require('postcss-preset-env')({}),
    require('tailwindcss')('web/wp-content/themes/belgium/tailwind.js'),
    require('cssnano')({}),
  ]
}
