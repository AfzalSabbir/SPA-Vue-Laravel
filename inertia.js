const _ = require('lodash')
const basePath = __dirname;
let publicPath = 'public/';

if(_.first(_.split(basePath, 'htdocs')) != basePath) publicPath = '/' + _.last(_.split(basePath, '\\')) + '/' + publicPath;
// if(_.first(_.split(basePath, 'localhost:')) != basePath) publicPath = '/';

module.exports = {
	publicPath: publicPath
};