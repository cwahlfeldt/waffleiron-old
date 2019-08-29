'use strict';

// Modules
const _ = require('lodash');
const LandoLaemp = require('./../laemp/builder.js');
const semver = require('semver');
const utils = require('./../../lib/utils');

// "Constants"
const DRUSH8 = '8.2.3';
const DRUSH7 = '7.4.0';

/*
 * Build Drupal 7
 */
module.exports = {
  name: '_drupaly',
  parent: '_recipe',
  config: {
    build: [],
    composer: {},
    confSrc: __dirname,
    config: {},
    database: 'mysql',
    defaultFiles: {
      php: 'php.ini',
    },
    php: '7.2',
    tooling: {drush: {
      service: 'appserver',
    }},
    via: 'apache',
    webroot: '.',
    xdebug: false,
  },
  builder: (parent, config) => class LandoDrupal extends LandoLaemp.builder(parent, config) {
    constructor(id, options = {}) {
      options = _.merge({}, config, options);
      // Set the default drush version if we don't have it
      if (!_.has(options, 'drush')) options.drush = (options.php === '5.3') ? DRUSH7 : DRUSH8;
      // Add the drush install command
      if (!_.isNull(semver.valid(options.drush)) && semver.major(options.drush) === 8) {
        options.build.unshift(utils.getDrush(options.drush, ['drush', '--version']));
      } else if (options.drush !== false) {
        options.composer['drush/drush'] = options.drush;
      }
      // Send downstream
      super(id, options);
    };
  },
};
