const { createServer } = require('http');
const { createProxyServer } = require('http-proxy');
const Path = require('path');
const Bundler = require('parcel-bundler');
const chokidar = require('chokidar');

const backEnd = {
  protocol: 'http',
  host: 'iron-tm.lndo.site',
};

const parcelEnd = {
  protocol: 'http',
  host: 'localhost',
  port: 1234
};

// parcel options, such as publicUrl, watch, sourceMaps... none of which are needed for this proxy server configuration
const options = {
  sourceMaps: true,
  watch: true,
};

// point parcel at its "input"
const entryFiles = Path.join(__dirname, 'web/wp-content/themes/belgium/public', 'index.html');

// init the bundler
const bundler = new Bundler(entryFiles, options);
  
bundler.serve();
 
// create a proxy server instance
const proxy = createProxyServer();

const watcher = chokidar.watch(`web/wp-content/themes/belgium/`, {ignored: `web/wp-content/themes/belgium/public`});

// serve
const server = createServer((req, res) => {
  if (req.url.includes('/')) {
    proxy.web(req, res, {
      // back-end server, local tomcat or otherwise
      target: backEnd,
      changeOrigin: true,
      autoRewrite: true
    });
  } else {
    proxy.web(req, res, {
      target: parcelEnd,
      ws: true
    });
  }
}).listen(1420);
