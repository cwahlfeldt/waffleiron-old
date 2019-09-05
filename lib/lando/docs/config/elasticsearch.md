# Elasticsearch

[Elasticsearch](https://www.elastic.co/products/elasticsearch) is a search and analytics engine, commonly used as a substitute for Solr or for collecting log and metrics data.

You can easily add it to your Lando app by adding an entry to the [services](./../config/services.md) top-level config in your [Landofile](./../config/lando.md).

[[toc]]

## Supported versions

*   [7](https://hub.docker.com/r/bitnami/elasticsearch)
*   [7.3](https://hub.docker.com/r/bitnami/elasticsearch)
*   [7.3.x](https://hub.docker.com/r/bitnami/elasticsearch)
*   **[6](https://hub.docker.com/r/bitnami/elasticsearch)** **(default)**
*   [6.5.x](https://hub.docker.com/r/bitnami/elasticsearch)
*   [5](https://hub.docker.com/r/bitnami/elasticsearch)
*   [5.6.x](https://hub.docker.com/r/bitnami/elasticsearch)
*   [custom](./../config/services.md#advanced)

## Patch versions

::: warning Not officially supported!
While we allow users to specify patch versions for this service they are not *officially* supported so if you use one YMMV.
:::

To use a patch version you can do something like this:

```yaml
services:
  my-service:
    type: elasticsearch:5.6.15
```

But make sure you use one of the available [patch tags](https://hub.docker.com/r/bitnami/elasticsearch/tags) for the underlying image we are using.

## Configuration

Here are the configuration options, set to the default values, for this service. If you are unsure about where this goes or what this means we *highly recommend* scanning the [services documentation](./../config/services.md) to get a good handle on how the magicks work.

Also note that the below options are in addition to the [build steps](./../config/services.md#build-steps) and [overrides](./../config/services.md#overrides) that are available to every service.

```yaml
services:
  my-service:
    type: elasticsearch:6
    portforward: false
    mem: 1025m
    plugins: []
    config:
      server: SEE BELOW
```

### Portforwarding

`portforward` will allow you to access this service externally by given you a port directly on your host's `localhost`. Note that `portforward` can be set to either `true` or a specific `port` but we *highly recommend* you set it to `true` unless you have pretty good knowledge of how port assignment works or you have a **very** compelling reason for needing a locked down port.

`portforward: true` will prevent inevitable port collisions and provide greater reliability and stability across Lando apps. That said, one downside of `portforward: true` is that Docker will assign a different port every time you restart your application. You can read more about accessing services externally [over here](./../guides/external-access.md).

`tl;dr`

**Recommended**

```yaml
services:
  my-service:
    type: elasticsearch
    portforward: true
```

**Not recommended**

```yaml
services:
  my-service:
    type: elasticsearch
    portforward: 9200
```

### Using a custom elasticsearch.yml

You may need to override the default config with your own [elasticsearch config file](https://www.elastic.co/guide/en/elasticsearch/reference/current/settings.html#settings). Note that [according to the underlying upstream image](https://github.com/bitnami/bitnami-docker-elasticsearch#configuration-file) this will _completely_ replace the default config. Further note that by default our elasticsearch services start as `data` nodes. If you want to activate your node to also be an `ingest` node then check out [this example](https://github.com/lando/lando/tree/master/examples/elasticsearch).

If you do this you must use a file that exists inside your applicaton and express it relative to your project root as below.

**A hypothetical project**

Note that you can put your configuration files anywhere inside your application directory. We use a `config` directory in the below example but you can call it whatever you want such as `.lando`.

```bash
./
|-- config
   |-- elasticsearch.yml
|-- .lando.yml
```

**Landofile's elastic config**

```yaml
services:
  my-service:
    type: elasticsearch
    config:
      server: config/elasticsearch.yml
```

## Getting information

You can get connection and credential information about your elasticsearch instance by running [`lando info`](./../cli/info.md). It may also be worth checking out our [accessing services externally guide](./../guides/external-access.md).
