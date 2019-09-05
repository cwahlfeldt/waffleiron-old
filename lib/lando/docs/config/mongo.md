# MongoDB

[MongoDB](https://en.wikipedia.org/wiki/MongoDB)  is a free and open-source cross-platform document-oriented database program. Classified as a NoSQL database program, MongoDB uses JSON-like documents with schemas.

You can easily add it to your Lando app by adding an entry to the [services](./../config/services.md) top-level config in your [Landofile](./../config/lando.md).

## Supported versions

*   [4.1](https://hub.docker.com/r/bitnami/mongodb)
*   **[4.0](https://hub.docker.com/r/bitnami/mongodb)** **(default)**
*   [3.6](https://hub.docker.com/r/bitnami/mongodb)
*   [custom](./../config/services.md#advanced)

## Patch versions

::: warning Not officially supported!
While we allow users to specify patch versions for this service they are not *officially* supported so if you use one YMMV.
:::

To use a patch version you can do something like this:

```yaml
services:
  my-service:
    type: mongo:4.1.4
```

But make sure you use one of the available [patch tags](https://hub.docker.com/r/bitnami/mongodb/tags) for the underlying image we are using.

## Configuration

Here are the configuration options, set to the default values, for this service. If you are unsure about where this goes or what this means we *highly recommend* scanning the [services documentation](./../config/services.md) to get a good handle on how the magicks work.

Also note that the below options are in addition to the [build steps](./../config/services.md#build-steps) and [overrides](./../config/services.md#overrides) that are available to every service.

```yaml
services:
  my-service:
    type: mongo:4.0
    portforward: false
    config:
      database: SEE BELOW
```

### Portforwarding

`portforward` will allow you to access this service externally by given you a port directly on your host's `localhost`. Note that ` portforward` can be set to either `true` or a specific `port` but we *highly recommend* you set it to `true` unless you have pretty good knowledge of how port assignment works or you have a **very** compelling reason for needing a locked down port.

`portforward: true` will prevent inevitable port collisions and provide greater reliability and stability across Lando apps. That said, one downside of `portforward: true` is that Docker will assign a different port every time you restart your application. You can read more about accessing services externally [over here](./../guides/external-access.md).

`tl;dr`

**Recommended**

```yaml
services:
  my-service:
    type: mongo
    portforward: true
```

**Not recommended**

```yaml
services:
  my-service:
    type: mongo
    portforward: 27018
```

### Using a custom MongoDB config file

You may need to override our [default mongo config](https://github.com/lando/lando/tree/master/plugins/lando-services/services/mongo) with your own [custom mongo config](https://docs.mongodb.com/manual/reference/configuration-options/).

If you do this you must use a file that exists inside your applicaton and express it relative to your project root as below.

**A hypothetical project**

Note that you can put your configuration files anywhere inside your application directory. We use a `config` directory in the below example but you can call it whatever you want such as `.lando`.

```bash
./
|-- config
   |-- custom.conf
|-- .lando.yml
```

**Landofile's mongo config**

```yaml
services:
  my-service:
    type: mongo
    config:
      database: config/custom.conf
```

## Getting information

You can get connection and credential information about your mongo instance by running [`lando info`](./../cli/info.md). It may also be worth checking out our [accessing services externally guide](./../guides/external-access.md).
