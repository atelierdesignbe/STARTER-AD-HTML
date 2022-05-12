const path = require('path')
const { CleanWebpackPlugin } = require('clean-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')

module.exports = {
  entry: './assets/js/index.js',
  output: {
    filename: 'main.bundle.js',
    path: path.resolve(__dirname, 'public/assets/js')
  },
  plugins:
  [
    new MiniCssExtractPlugin({
      filename: '../css/main.css'
    }),
    new CleanWebpackPlugin()
  ],
  module: {
    rules: [
      // CSS
      {
        test: /\.(sa|sc|c)ss$/,
        use: [MiniCssExtractPlugin.loader, 'css-loader', {
          loader: 'postcss-loader',
          options: {
            postcssOptions: {
              plugins: [
                [
                  'postcss-preset-env',
                  'autoprefixer',
                  {
                    // Options
                  }
                ]
              ]
            }
          }
        }, 'sass-loader']
      },

      // JS
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env']
          }
        }
      },

      // Images
      {
        test: /\.(jpe?g|png|gif|svg)$/,
        type: 'asset/resource',
        generator: {
          filename: '../images/[hash][ext]'
        }
      },

      // Fonts
      {
        test: /\.(ttf|eot|otf|woff|woff2)$/,
        type: 'asset/resource',
        generator: {
          filename: '../fonts/[hash][ext]'
        }
      }
    ]
  }
}
