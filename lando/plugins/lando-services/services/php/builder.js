'use strict';

// Modules
const _ = require('lodash');
const path = require('path');
const semver = require('semver');
const utils = require('./../../lib/utils');

/*
 * Helper to get nginx config
 */
const nginxConfig = options => ({
  app: options.app,
  config: _.merge({}, {
    vhosts: `${options.confDest}/${options.defaultFiles.vhosts}`,
  }, options.config),
  confDest: path.resolve(options.confDest, '..', 'nginx'),
  home: options.home,
  name: `${options.name}_nginx`,
  overrides: utils.cloneOverrides(options.overrides),
  project: options.project,
  root: options.root,
  ssl: options.nginxSsl,
  type: 'nginx',
  userConfRoot: options.userConfRoot,
  version: '1.14',
  webroot: options.webroot,
});

/*
 * Helper to build a package string
 */
const pkger = (pkg, version) => (!_.isEmpty(version)) ? `${pkg}:${version}` : pkg;

/*
 * Helper to parse apache config
 */
const parseApache = options => {
  if (options.ssl) options.defaultFiles.vhosts = 'default-ssl.conf';
  options.volumes.push(`${options.confDest}/${options.defaultFiles.vhosts}:${options.remoteFiles.vhosts}`);
  if (options.version === '5.3') options.environment.APACHE_LOG_DIR = '/var/log';
  return options;
};

/*
 * Helper to parse cli config
 */
const parseCli = options => {
  options.command = ['tail -f /dev/null'];
  return options;
};

/*
 * Helper to parse nginx config
 */
const parseNginx = options => {
  options.command = (process.platform !== 'win32') ? ['php-fpm'] : ['php-fpm -R'];
  options.image = 'fpm';
  options.remoteFiles.vhosts = '/opt/bitnami/extra/nginx/templates/default.conf.tpl';
  options.defaultFiles.vhosts = (options.ssl) ? 'default-ssl.conf.tpl' : 'default.conf.tpl';
  options.nginxSsl = options.ssl;
  options.ssl = false;
  if (process.platform === 'win32') {
    options.volumes.push(`${options.confDest}/zz-lando.conf:/usr/local/etc/php-fpm.d/zz-lando.conf`);
  }
  options.remoteFiles.pool = '/usr/local/etc/php-fpm.d/zz-lando.conf';
  return options;
};

/*
 * Helper to parse php config
 */
const parseConfig = options => {
  switch (options.via.split(':')[0]) {
    case 'apache': return parseApache(options);
    case 'cli': return parseCli(options);
    case 'nginx': return parseNginx(options);
  };
};

// Builder
module.exports = {
  name: 'php',
  config: {
    version: '7.3',
    supported: ['7.3', '7.2', '7.1', '7.0', '5.6', '5.5', '5.4', '5.3'],
    legacy: ['5.5', '5.4', '5.3'],
    path: [
      '/app/vendor/bin',
      '/usr/local/sbin',
      '/usr/local/bin',
      '/usr/sbin',
      '/usr/bin',
      '/sbin',
      '/bin',
      '/var/www/.composer/vendor/bin',
    ],
    confSrc: __dirname,
    command: ['sh -c \'a2enmod rewrite && apache2-foreground\''],
    image: 'apache',
    defaultFiles: {
      _php: 'php.ini',
      vhosts: 'default.conf',
      // server: @TODO? DO THE PEOPLE DEMAND IT?
    },
    environment: {
      COMPOSER_ALLOW_SUPERUSER: 1,
      PHP_MEMORY_LIMIT: '1G',
    },
    remoteFiles: {
      _php: '/usr/local/etc/php/conf.d/xxx-lando-default.ini',
      vhosts: '/etc/apache2/sites-enabled/000-default.conf',
      php: '/usr/local/etc/php/conf.d/zzz-lando-my-custom.ini',
    },
    sources: [],
    ssl: false,
    via: 'apache',
    volumes: ['/usr/local/bin'],
    webroot: '.',
  },
  parent: '_appserver',
  builder: (parent, config) => class LandoPhp extends parent {
    constructor(id, options = {}, factory) {
      options = parseConfig(_.merge({}, config, options));
      // Mount our default php config
      options.volumes.push(`${options.confDest}/${options.defaultFiles._php}:${options.remoteFiles._php}`);

      // Shift on the docker entrypoint if this is a more recent version
      // @TODO: can we assume we will always have major.minor for php release?
      if (options.version !== 'custom' && semver.gt(`${options.version}.0`, '5.5.0')) {
        options.command.unshift('docker-php-entrypoint');
      }

      // Build the php
      const php = {
        image: `devwithlando/php:${options.version}-${options.image}-2`,
        environment: _.merge({}, options.environment, {
          PATH: options.path.join(':'),
          LANDO_WEBROOT: `/app/${options.webroot}`,
          XDEBUG_CONFIG: `remote_enable=true remote_host=${options._app.env.LANDO_HOST_IP}`,
        }),
        networks: (_.startsWith(options.via, 'nginx')) ? {default: {aliases: ['fpm']}} : {default: {}},
        ports: (_.startsWith(options.via, 'apache') && options.version !== 'custom') ? ['80'] : [],
        volumes: options.volumes,
        command: options.command.join(' '),
      };
      options.info = {via: options.via};

      // Add our composer things to run step
      if (!_.isEmpty(options.composer)) {
        const commands = utils.getInstallCommands(options.composer, pkger, ['composer', 'global', 'require']);
        utils.addBuildStep(commands, options._app, options.name, 'build_internal');
      }

      // Add activate steps for xdebug
      if (options.xdebug) {
        utils.addBuildStep(['docker-php-ext-enable xdebug'], options._app, options.name, 'build_as_root_internal');
      }

      // Add in nginx if we need to
      if (_.startsWith(options.via, 'nginx')) {
        const nginxOpts = nginxConfig(options);
        const LandoNginx = factory.get('nginx');
        const nginx = new LandoNginx(nginxOpts.name, nginxOpts);
        nginx.data.push({services: _.set({}, nginxOpts.name, {'depends_on': [options.name]})});
        options.sources.push(nginx.data);
        options.info.served_by = nginxOpts.name;
      }

      // Add in the php service and push downstream
      options.sources.push({services: _.set({}, options.name, php)});
      super(id, options, ..._.flatten(options.sources));
    };
  },
};
