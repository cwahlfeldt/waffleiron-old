module.exports = (ctx) => ({
  plugins: [
    require('postcss-import')({}),
    require('postcss-preset-env')({}),
    require('tailwindcss')({}),
    // require('cssnano')({}),
  ]
})
