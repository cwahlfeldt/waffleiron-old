const { createServer } = require('http')
const { createProxyServer } = require('http-proxy')
const postcssWalk = require('postcss-walk')

const backEnd = {
  protocol: 'http',
  host: 'iron-tm.lndo.site',
};

const frontEnd = {
  protocol: 'http',
  host: 'localhost',
  port: 1421
};

// create a proxy server instance
const proxy = createProxyServer();

// serve
createServer((req, res) => {
  if (req.url.includes('/')) {
    proxy.web(req, res, {
      // back-end server, local tomcat or otherwise
      target: backEnd,
      changeOrigin: true,
      autoRewrite: true
    });
  } else {
    proxy.web(req, res, {
      target: frontEnd,
      ws: true
    });
  }
}).listen(1420);

// process css
const input  = 'web/wp-content/themes/belgium/src/styles/mod.css'
const output = 'web/public/out.css'
const plugins = [
  require('postcss-import')({}),
  require('postcss-preset-env')({}),
  require('tailwindcss')('web/wp-content/themes/belgium/tailwind.js'),
  require('cssnano')({}),
]
postcssWalk({
  input,
  output,
  indexName: 'mod.css',
  plugins, log: true,
  watch: true
})
