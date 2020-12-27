const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');

module.exports = (env = {}) => {
    let ENV = env.env;
    if ( undefined === ENV || (ENV !== 'prod' && ENV !== 'dev') ) {
        ENV = 'dev';
    }

    let msg = `\n\n =========================
				 \n\n  deploying >${ENV}< stuff
				 \n\n =========================\n\n`;

    console.log(msg);

    const plugins = [
        new MiniCssExtractPlugin(),
    ];

    if ( ENV === 'prod' ) {
        plugins.push(new OptimizeCSSAssetsPlugin({}))
    }

    console.log(path.resolve(__dirname, './'));

    //webpack 4 uses 'development' and 'production' and will minify code accordingly (no need for plugins)
    const mode = ENV === 'dev' ? 'development' : 'production';

    return {
        mode,
        entry: {
            'assets/js/main.js': './assets/src/js/main.js',
            'assets/css/main': './assets/src/sass/main.scss'
        },
        output: {
            path: path.resolve(__dirname, './'),
            filename: '[name]'
        },
        devtool: ENV === 'dev' ? 'cheap-module-source-map' : '',
        plugins: plugins,
        module: {
            rules: [
                {
                    test: /\.(js)$/,
                    exclude: /node_modules/,
                    use: {
                        loader: 'babel-loader',
                        options: {
                            presets: ['@babel/preset-env'],
                            compact: ENV === 'prod',
                            comments: ENV !== 'prod',
                            minified: ENV === 'prod',
                            sourceMaps: ENV === 'dev'
                        }

                    }

                },

                {
                    test: /\.(scss)$/,
                    use: [
                        {
                            loader: MiniCssExtractPlugin.loader,
                            options: {},
                        },
                        {
                            loader: 'css-loader',
                            options: {
                                sourceMap: ENV === 'dev',
                                url: false
                            }
                        },
                        {
                            loader: 'postcss-loader',
                            options: {
                                sourceMap: ENV === 'dev',
                                plugins: () => [require('autoprefixer')({
                                    grid: true
                                })]
                            }
                        },
                        {
                            loader: 'sass-loader',
                            options: {
                                sourceMap: ENV === 'dev',
                            }
                        }

                    ],
                },
            ]
        }
    }
};


