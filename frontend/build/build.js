require('./check-versions')()

process.env.NODE_ENV = 'production'

var path = require('path')
var ora = require('ora')
var rm = require('rimraf')
var path = require('path')
var chalk = require('chalk')
var webpack = require('webpack')
var config = require('../config')
var webpackConfig = require('./webpack.prod.conf')
var proxyMiddleware = require('http-proxy-middleware')
var spinner = ora('building for production...')
spinner.start()

rm(path.join(config.build.assetsRoot, config.build.assetsSubDirectory), err => {
  if (err) throw err
  webpack(webpackConfig, function (err, stats) {
    spinner.stop()
    if (err) throw err
    process.stdout.write(stats.toString({
      colors: true,
      modules: false,
      children: false,
      chunks: false,
      chunkModules: false
    }) + '\n\n')

    console.log(chalk.cyan('  Build complete.\n'))
    console.log(chalk.yellow(
      '  Tip: built files are meant to be served over an HTTP server.\n' +
      '  Opening index.html over file:// won\'t work.\n'
    ))

    var app = express()
    var proxyTable = config.dev.proxyTable

    // proxy api requests
    Object.keys(proxyTable).forEach(function (context) {
      var options = proxyTable[context]
      if (typeof options === 'string') {
        options = { target: options }
      }
      app.use(proxyMiddleware(options.filter || context, options))
    })

    app.use(require('connect-history-api-fallback')())

    var staticPath = path.posix.join(config.dev.assetsPublicPath, config.dev.assetsSubDirectory)
    app.use(staticPath, express.static('./dist/static'))

    var uri = '0.0.0.0:8080'

    var _resolve
    var readyPromise = new Promise(resolve => {
      _resolve = resolve
    })

    console.log('> Starting production server...')

    var server = app.listen(port)

    module.exports = {
      ready: readyPromise,
      close: () => {
        server.close()
      }
    }

  })
})
