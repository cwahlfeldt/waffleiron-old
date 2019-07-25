module.exports = function (arg) {
  return {
    plugins: [
      require('postcss-import')({}),
      require('postcss-preset-env')({}),
      require('tailwindcss')({}),
      require('cssnano')({}),
    ]
  }
}
