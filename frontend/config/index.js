var path = require('path')

module.exports = {
  build: {
    env: require('./prod.env'),
    index: path.resolve(__dirname, '../dist/index.html'),
    assetsRoot: path.resolve(__dirname, '../dist'),
    assetsSubDirectory: 'static',
    assetsPublicPath: '/',
    productionSourceMap: true,
    productionGzip: false,
    productionGzipExtensions: ['js', 'css']
  },
  dev: {
    env: require('./dev.env'),
    port: 8080,
    domain: 'http://vueintranet.dev',
    assetsSubDirectory:  'static', // changed from static
    assetsPublicPath: '/',
    headers: { "Access-Control-Allow-Origin": "*" },
    proxyTable: {
      // proxy all requests starting with /api to http://localhost:8000
      '/api': {
        target: 'http://vueintranet.dev:8000',
        changeOrigin: true
      }
    },
    cssSourceMap: false
  },
  prod: {
    env: require('./dev.env'),
    port: 8080,
    domain: 'http://vueintranet.dev',
    assetsSubDirectory:  'static', // changed from static
    assetsPublicPath: '/',
    headers: { "Access-Control-Allow-Origin": "*" },
    proxyTable: {
      // proxy all requests starting with /api to http://localhost:8000
      '/api': {
        target: 'http://vueintranet.dev:8000',
        changeOrigin: true
      }
    },
    cssSourceMap: false
  }
}
