const path = require('path');


module.exports = {

    paths: function (paths, env) {
        paths.appSrc = path.resolve(__dirname, 'client/src');
        paths.appHtml = path.resolve(__dirname, 'client/public/index.html');
        paths.appIndexJs = path.resolve(__dirname, 'client/src/index.js');
        paths.appBuild = path.resolve(__dirname, 'public/dist');
        paths.appPublic = path.resolve(__dirname, 'client/public');
        return paths;
    },
}