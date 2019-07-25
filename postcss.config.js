module.exports = (ctx) => ({
  map: true,
  plugins: [
    require('postcss-import')({}),
    require('postcss-preset-env')({}),
    require('tailwindcss')({}),
    require('cssnano')({}),
  ]
})
