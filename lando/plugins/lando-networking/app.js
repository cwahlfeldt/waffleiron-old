'use strict';

// Modules
const _ = require('lodash');

/*
 * @TODO
 */
module.exports = (app, lando) => {
  // Add all the apps containers to the lando bridge network after the app starts
  // @NOTE: containers are automatically removed when the app stops
  app.events.on('post-start', 1, () => {
    // We assume the lando net exists at this point
    const landonet = lando.engine.getNetwork(lando.config.networkBridge);
    // List all our app containers
    return lando.engine.list({project: app.project})
    // Go through each container
    .map(container => {
      // Grab from the proxy if we have them
      const aliases = _.compact(_.get(app, `config.proxy.${container.service}`, []));
      // And add in our default alias
      aliases.push(`${container.service}.${container.app}.internal`);
      // Sometimes you need to disconnect before you reconnect
      return landonet.disconnect({Container: container.id, EndpointConfig: {Aliases: aliases}})
      // Only throw non not connected errors
      .catch(error => {
        if (!_.includes(error.message, 'is not connected to network lando')) throw error;
      })
      // Connect
      .then(() => {
        landonet.connect({Container: container.id, EndpointConfig: {Aliases: aliases}});
        lando.log.info('Connected %s to the landonet', container.name);
      });
    });
  });

  // Add in the hostname infos
  app.events.on('post-init', 1, () => {
    _.forEach(app.info, data => {
      data.hostnames = _.get(data, 'hostnames', []);
      data.hostnames.push([data.service, app.project, 'internal'].join('.'));
    });
  });
};
