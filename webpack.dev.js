const { merge } = require('webpack-merge')
const common = require('./webpack.common')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')

module.exports = merge(common, {
  mode: 'development',
  devtool: 'inline-source-map',
  devServer: {
    devMiddleware: {
      writeToDisk: true
    },
  },
  watch: true,
  plugins: [
    new BrowserSyncPlugin({
      files: ['*.php','*.php', '**/*.php', 'views', 'inc'],
      proxy: 'http://speos.local'
    })
  ],

})
