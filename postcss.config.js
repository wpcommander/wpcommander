const tailwindcss  = require('tailwindcss');
const autoprefixer = require('autoprefixer');
const postcss      = require('postcss');

const parent_selector = '.pluginFileName'

module.exports = {
	plugins: [tailwindcss('./tailwind.config.js'), postcss.plugin('wp_commander', function () {
		return function (root) {
			root.nodes.map(node => {
				if (node.selectors !== undefined) {
					node.selectors = node.selectors.map((selector, index) => {
						return parent_selector + ' ' + selector;
					})
				}
				return node;
			})
			return root;
		}
	}), autoprefixer]
};
