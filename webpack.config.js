const path = require('path');

const defaultConfig = require('@wordpress/scripts/config/webpack.config');

const js = {
	...defaultConfig,
	entry: {
		// add your all js entry
	},
	output: {
		path: path.resolve(__dirname, './assets/js/'),
		filename: '[name].js',
		clean: false
	}
}

const scss = {
	...defaultConfig,
	entry: {
		// add your all scss entry
	},
	output: {
		path: path.resolve(__dirname, './assets/css/'),
		clean: false
	},
	module: {
		...defaultConfig.module,
		rules: [
			...defaultConfig.module.rules,
			{
				test: /\.css$/i,
				use: ['style-loader', 'css-loader', 'postcss-loader'],
			},
		],
	}
};

module.exports = [scss, js];
