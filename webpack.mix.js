const path = require('path')
const mix = require('laravel-mix')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
  .ts('resources/js/app.ts', 'public/dist/js')
  .vue()
  .postCss('resources/css/app.css', 'public/dist/css', [require('tailwindcss')])
  .sourceMaps(false)
  .version()
  .extract()
  .webpackConfig({
    output: {
      chunkFilename: 'dist/js/chunks/[chunkhash].js',
    },
  })
  .alias({
    '@': path.resolve(__dirname, 'resources', 'js'),
  })
