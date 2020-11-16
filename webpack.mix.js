const path = require('path')
const { exec } = require('child_process')
const mix = require('laravel-mix')

mix.extend('ziggy', {
  boot() {
    const command = () =>
      exec('php artisan ziggy:generate resources/js/generated/ziggy.js')

    command()

    if (Mix.isWatching()) {
      require('chokidar')
        .watch('routes/**/*.php')
        .on('change', path => {
          console.log(`${path} has been changed!`)
          command()
        })
    }
  },
})

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
    resolve: {
      alias: {
        '@': path.resolve(__dirname, 'resources', 'js'),
        ziggy: path.resolve(__dirname, 'vendor', 'tightenco', 'ziggy', 'dist'),
      },
    },
  })
  .ziggy()
