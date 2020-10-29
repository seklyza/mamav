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

const allEnv = require('dotenv').config().parsed
const env = Object.keys(allEnv)
  .filter(key => key.startsWith('MIX_'))
  .reduce((all, curr) => ({ [curr]: allEnv[all], ...all }), {})

mix
  .ts('resources/js/app.ts', 'public/js')
  .vue()
  .postCss('resources/css/app.css', 'public/css', [require('tailwindcss')])
  .sourceMaps(false)
  .version()
  .webpackConfig(webpack => ({
    plugins: [
      new webpack.DefinePlugin({
        'process.env': JSON.stringify(env),
      }),
    ],
  }))
