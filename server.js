const { createServer } = require('http');
const { createProxyServer } = require('http-proxy');
const concurrently = require('concurrently');

const backEnd = {
  protocol: 'http',
  host: 'iron-tm.lndo.site',
  port: 8080
};

const proxyEnd = {
  protocol: 'http',
  host: 'localhost',
  port: 1420
};

// create a proxy server instance
const proxy = createProxyServer();

concurrently([ 'npm:watch-*' ], {})
  .then(res => ({ res }));
 
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
    // parcel's dev server
    proxy.web(req, res, {
      target: proxyEnd,
      ws: true
    });
  }
})
