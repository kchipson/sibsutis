/*jshint esversion: 6 */

// Files path
const path = require( 'path' );

module.exports = {
	entry: {
		'assets/js/script': path.resolve( __dirname, 'assets/js/src/app.js' )
	},
	output: {
		path: path.resolve( __dirname ),
		filename: '[name].js'
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				include: '/assets/js/src',
				use: {
					loader: 'babel-loader'
				}
			}
		]
	}
};
