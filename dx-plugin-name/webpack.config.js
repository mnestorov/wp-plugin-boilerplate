const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
var path = require('path');

module.exports = {
    entry: {
        admin: './assets/src/admin/js/plugin-name-admin.js',
        public: './assets/src/public/js/plugin-name-public.js',
    },
    output: {
        filename: '[name].min.js',
        path: path.resolve(__dirname, ['assets/src/admin/js', 'assets/src/public/js'])
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '[name].min.css',
        }),

        // Uncomment this if you want to use CSS Live reload
        /*
        new BrowserSyncPlugin({
          proxy: localDomain,
          files: [ outputPath + '/*.css' ],
          injectCss: true,
        }, { reload: false, }),
        */
    ],
    module: {
        rules: [
            {
                test: /\.s?[c]ss$/i,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'sass-loader'
                ]
            },
            {
                test: /\.sass$/i,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    {
                        loader: 'sass-loader',
                        options: {
                            sassOptions: { indentedSyntax: true }
                        }
                    }
                ]
            },
            {
                test: /\.(jpg|jpeg|png|gif|woff|woff2|eot|ttf|svg)$/i,
                use: 'url-loader?limit=1024'
            }
        ]
    },
};