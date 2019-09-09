'use strict';

// Modules
const _ = require('lodash');
const AsyncEvents = require('./events');
const format = require('util').format;
const hasher = require('object-hash');
const path = require('path');
const Promise = require('./promise');
const utils = require('./utils');

/*
 * Helper to init and then report
 */
const initAndReport = (app, method = 'start') => app.init()
  .then(() => app.metrics.report(method, utils.metricsParse(app)));

/*
 * Helper to load in all app plugins
 */
const loadPlugins = (app, lando) => Promise.resolve(app.plugins.registry)
  // Filter out
  .filter(plugin => _.has(plugin, 'app'))
  // LOADEM!
  .map(plugin => app.plugins.load(plugin, plugin.app, app, lando))
  // Remove any naughty shit
  .map(plugin => _.pick(plugin.data, ['config', 'composeData', 'env', 'labels']))
  // Merge minotaur
  .each(result => _.merge(app, result));

/**
 * The class to instantiate a new App
 *
 * @since 3.0.0
 * @name app
 * @param {String} name Name of the app
 * @param {Object} config Config for the app
 * @param {Object} [lando={}] A Lando instance
 * @return {App} An App instance
 */
module.exports = class App {
  constructor(name, config, lando = {}) {
    /**
     * The apps name
     *
     * @since 3.0.0
     * @alias app.name
     */
    this.name = utils.appMachineName(name),
    this.project = utils.dockerComposify(name);
    this._config = lando.config;
    this._dir = path.join(this._config.userConfRoot, 'compose', this.project);
    this._message = lando.message;
    this._lando = lando;
    this._name = name;
    /**
     * The apps configuration
     *
     * @since 3.0.0
     * @alias app.config
     */
    this.config = config;
    this.configFiles = config.files;
    this.ComposeService = lando.factory.get('_compose');
    this.engine = lando.engine;
    this.env = _.cloneDeep(this._config.appEnv);
    /**
     * The apps event emitter
     *
     * @since 3.0.0
     * @alias app.events
     */
    this.events = new AsyncEvents(lando.log);
    /**
     * Information about this app
     *
     * @since 3.0.0
     * @alias app.info
     */
    this.info = [];
    this.labels = _.cloneDeep(this._config.appLabels);
    this.log = lando.log;
    this.opts = {};
    this.plugins = lando.plugins;
    this.metaCache = `${this.name}.meta.cache`;
    this.meta = lando.cache.get(this.metaCache);
    this.metrics = lando.metrics;
    /**
     * The apps root directory
     *
     * @since 3.0.0
     * @alias app.root
     */
    this.root = path.dirname(this.configFiles[0]);
    /**
     * Tasks and commands the app can run
     *
     * @since 3.0.0
     * @alias app.tasks
     */
    this.tasks = [];
    this.id = hasher(`${this.name}-${this.root}`);
  };

  /*
   * @TODO, add compose data to the add
   */
  add(data, front = false) {
    if (front) this.composeData.unshift(data);
    else this.composeData.push(data);
  }

  /**
   * Hard removes all app services, volumes, networks, etc.
   *
   * This differs from `uninstall` in that uninstall will only soft remove all app
   * services, while maintaining things like volumes, networks, etc.
   *
   * That said this DOES call both `stop` and `uninstall` under the hood.
   *
   * @since 3.0.0
   * @alias app.destroy
   * @fires pre_destroy
   * @fires pre_stop
   * @fires post_stop
   * @fires pre_uninstall
   * @fires post_uninstall
   * @fires post_destroy
   * @return {Promise} A Promise
   */
  destroy() {
    // Start it off
    this.message('Destroying %s', this.name);
    return initAndReport(this, 'destroy')

    /**
     * Event that runs before an app is destroyed.
     *
     * @since 3.0.0
     * @alias app.events:pre-destroy
     * @event pre_destroy
     */
    .then(() => this.events.emit('pre-destroy'))

    // Make sure app is stopped.
    .then(() => this.stop())
    // Uninstall app.
    .then(() => this.uninstall(true))

    /**
     * Event that runs after an app is destroyed.
     *
     * @since 3.0.0
     * @alias app.events:post-destroy
     * @event post_destroy
     */
    .then(() => this.events.emit('post-destroy'));
  };

  /**
   * Initializes the app
   *
   * You will want to run this to get the app ready for lando.engine. This will
   * load in relevant app plugins, build the docker compose files and get them ready to go
   *
   * @since 3.0.0
   * @alias app.init
   * @fires pre_init
   * @fires post_init
   * @fires ready
   * @return {Promise} A Promise.
   */
  init() {
    // We should only need to initialize once, if we have just go right to app ready
    if (this.initialized) return this.events.emit('ready', this);
    // Get compose data if we have any, otherwise set to []
    const composeFiles = utils.loadComposeFiles(_.get(this, 'config.compose', []), this.root, this.version);
    this.composeData = [new this.ComposeService('compose', {}, ...composeFiles)];
    // Validate and set env files
    this.envFiles = utils.validateFiles(_.get(this, 'config.env_file', []), this.root);
    // Log some things
    this.log.verbose('Initiatilizing app %s from %s', this.name, this.root);
    this.log.debug('App %s uses config %j', this.name, this.config);

    /**
     * Event that allows altering of the app object right before it is
     * initialized.
     *
     * Note that this is a global event so it is invoked with `lando.events.on`
     * not `app.events.on` See example below:
     *
     * @since 3.0.0
     * @alias app.events:pre-init
     * @event pre_init
     * @property {App} app The app instance.
     */
    return loadPlugins(this, this._lando).then(() => this.events.emit('pre-init', this))

    // Actually assemble this thing so its ready for that engine
    .then(() => {
      // Get all the services
      this.services = utils.getServices(this.composeData);
      // Merge whatever we have thus far together
      this.info = utils.getInfoDefaults(this);
    })
    /**
     * Event that allows altering of the app object right after it has been
     * full initialized and all its plugins have been loaded.
     *
     * @since 3.0.0
     * @alias app.events:post-init
     * @event post_init
     * @property {App} app The app instance.
     */
    .then(() => this.events.emit('post-init', this))
    // Finish up
    .then(() => {
      // Front load our globals
      this.add(new this.ComposeService('globals', {}, {services: utils.getGlobals(this)}), true);
      // Take the big dump of all our compose stuff
      this.compose = utils.dumpComposeData(this.composeData, this._dir);
      // Log
      this.initialized = true;
      this.log.info('App %s is ready!', this.name);
      this.log.verbose('App %s has compose files %j', this.project, this.compose);
      this.log.debug('App %s has config', this.name, this.config);
    })
    /**
     * Event that runs when the app is ready for action
     *
     * @since 3.0.0
     * @alias app.events:ready
     * @event ready
     * @property {App} app The app instance.
     */
    .then(() => this.events.emit('ready', this));
  };

  /*
   * @TODO
   */
  message(...args) {
    const content = format(...args);
    return this._message({
      app: this.name,
      context: 'app',
      message: content,
      type: 'info',
    })
    .then(() => {
      this.log.info(content);
    });
  };

  /**
   * Rebuilds an app.
   *
   * This will stop an app, soft remove its services, rebuild those services and
   * then, finally, start the app back up again. This is useful for developers who
   * might want to tweak Dockerfiles or compose yamls.
   *
   * @since 3.0.0
   * @alias app.rebuild
   * @fires pre_stop
   * @fires post_stop
   * @fires pre_rebuild
   * @fires pre_uninstall
   * @fires post_uninstall
   * @fires post_rebuild
   * @fires pre_start
   * @fires post_start
   * @return {Promise} A Promise.
   */
  rebuild() {
    // Start it off
    this.message('Rebuilding %s', this.name);
    return initAndReport(this, 'rebuild')

    /**
     * Event that runs before an app is rebuilt.
     *
     * @alias app.events:pre-rebuild
     * @event pre_rebuild
     */
    .then(() => this.events.emit('pre-rebuild'))
    // Stop app.
    .then(() => this.stop())
    // Uninstall app
    .then(() => this.uninstall())
    // Repull/build components.
    .then(() => this.engine.build(this))
    // Install app.
    .then(() => this.start())
    /**
     * Event that runs after an app is rebuilt.
     *
     * @since 3.0.0
     * @alias app.events:post-rebuild
     * @event post_rebuild
     */
    .then(() => this.events.emit('post-rebuild'));
  };

 /*
  * @TODO
  */
  reset() {
    this.initialized = false;
  };

 /**
   * Stops and then starts an app.
   *
   * This just runs `app.stop` and `app.start` in succession.
   *
   * @since 3.0.0
   * @alias app.restart
   * @fires pre_stop
   * @fires post_stop
   * @fires pre_start
   * @fires post_start
   * @param {Object} app - A fully instantiated app object
   * @return {Promise} A Promise.
   */
  restart() {
    // Start it off
    this.message('Restarting %s', this.name);
    // stop/start
    return this.stop().then(() => this.start());
  };

  /**
   * Starts an app.
   *
   * This will start up all services/containers that have been defined for this app.
   *
   * @since 3.0.0
   * @alias app.start
   * @fires pre_start
   * @fires post_start
   * @return {Promise} A Promise.
   *
   */
  start() {
    // Log
    this.message('Starting app name %s!', this.name);
    return initAndReport(this)

    /**
     * Event that runs before an app starts up.
     *
     * This is useful if you want to start up any support services before an app
     * stars.
     *
     * @since 3.0.0
     * @alias app.events:pre-start
     * @event pre_start
     */
    .then(() => this.events.emit('pre-start'))

    // Start core containers
    .then(() => this.engine.start(this))

    /**
     * Event that runs after an app is started.
     *
     * This is useful if you want to perform additional operations after an app
     * starts such as running additional build commands.
     *
     * @since 3.0.0
     * @alias app.events:post-start
     * @event post_start
     */
    .then(() => this.events.emit('post-start'));
  };

  /**
   * Stops an app.
   *
   * This will stop all services/containers that have been defined for this app.
   *
   * @since 3.0.0
   * @alias app.stop
   * @fires pre_stop
   * @fires post_stop
   * @return {Promise} A Promise.
   */
  stop() {
    // Stop it!
    this.message('Stopping %s', this.name);
    return initAndReport(this, 'stop')

    /**
     * Event that runs before an app stops.
     *
     * @since 3.0.0
     * @alias app.events:pre-stop
     * @event pre_stop
     */
    .then(() => this.events.emit('pre-stop'))

    // Stop components.
    .then(() => this.engine.stop(this))

    /**
     * Event that runs after an app stop.
     *
     * @since 3.0.0
     * @alias app.events:post-stop
     * @event post_stop
     */
    .then(() => this.events.emit('post-stop'));
  };

  /**
   * Soft removes the apps services but maintains persistent data like app volumes.
   *
   * This differs from `destroy` in that destroy will hard remove all app services,
   * volumes, networks, etc as well as remove the app from the appRegistry.
   *
   * @since 3.0.0
   * @alias app.uninstall
   * @fires pre_uninstall
   * @fires post_uninstall
   * @param {Boolean} purge - A fully instantiated app object
   * @return {Promise} A Promise.
   */
  uninstall(purge = false) {
    // Cleaning up
    this.message('Uninstalling %s', this.name);
    return initAndReport(this, 'uninstall')

    /**
     * Event that runs before an app is uninstalled.
     *
     * This is useful if you want to add or remove parts of the uninstall process.
     * For example, it might be nice to persist a container whose data you do not
     * want to replace in a rebuild and that cannot persist easily with a volume.
     *
     * @since 3.0.0
     * @alias app.events:pre-uninstall
     * @event pre_uninstall
     */
    .then(() => this.events.emit('pre-uninstall'))

    // Kill components.
    .then(() => this.engine.destroy(_.merge({}, this, {opts: {purge}})))

    /**
     * Event that runs after an app is uninstalled.
     *
     * This is useful if you want to do some additional cleanup steps after an
     * app is uninstalled such as invalidating any cached data.
     *
     * @since 3.0.0
     * @alias app.events:post-uninstall
     * @event post_uninstall
     */
    .then(() => this.events.emit('post-uninstall'));
  };
};
