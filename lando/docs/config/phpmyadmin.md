# PhpMyAdmin

[phpMyAdmin](https://www.phpmyadmin.net/) is a free software tool written in PHP, intended to handle the administration of MySQL over the Web.

You can easily add it to your Lando app by adding an entry to the [services](./../config/services.md) top-level config in your [Landofile](./../config/lando.md).

[[toc]]

## Supported versions

*   **[4.7](https://hub.docker.com/r/phpmyadmin/phpmyadmin/)** **(default)**
*   [4.6](https://hub.docker.com/r/phpmyadmin/phpmyadmin/)
*   [custom](./../config/services.md#advanced)

## Patch versions

This service does not support patch versions but if you **really** need something like that you could consider using either a [custom compose service](./compose.md) or a service [overrides](./../config/services.md#overrides).

## Configuration

Here are the configuration options, set to the default values, for this service. If you are unsure about where this goes or what this means we *highly recommend* scanning the [services documentation](./../config/services.md) to get a good handle on how the magicks work.

Also note that the below options are in addition to the [build steps](./../config/services.md#build-steps) and [overrides](./../config/services.md#overrides) that are available to every service.

```yaml
services:
  my-service:
    type: phpmyadmin:4.7
    hosts: []
    config:
      config: SEE BELOW
    overrides:
      environment: SEE BELOW
```

### Connecting to database services

You will need to list the database services you want to be able to access via `phpmyadmin`. Note that the services in this list should be other MySQLy services in your application. They can be discovered by running [lando info](./../cli/info.md).

::: warning Note that PhpMyAdmin is designed specifically for MySql and MariaDB type databases!
You will likely be sad if you try to use a non-MySQL-ish database.
:::

Here is an example of a Landofile's `services` config that connects to two `mysql` database backends called `mysql57` and `mysql8`.

```yaml
services:
  my-service:
    type: phpmyadmin
    hosts:
      - mysql57
      - mysql8
  mysql57:
    type: mysql:5.7
  mysql8:
    type: mysql:8
```

### Using custom phpmyadmin config file

You can override the default `phpmyadmin` config by setting a custom [phpMyAdmin config file](https://docs.phpmyadmin.net/en/latest/config.html) as below.

**A hypothetical project**

Note that you can put your configuration files anywhere inside your application directory. We use a `config` directory in the below example but you can call it whatever you want such as `.lando`.

```bash
./
|-- config
   |-- config.user.inc.php
|-- .lando.yml
```

**Landofile's phpmyadmin config**

```yaml
services:
  my-service:
    type: phpmyadmin
    config:
      config: config/config.user.inc.php
```

### Advanced

There are also [serveral various envvars](https://hub.docker.com/r/phpmyadmin/phpmyadmin/) exposed by the underlying image we use that you can set to further customize how your PhpMyAdmin works. **These are not officially supported** so we *highly recommend* you do not alter them unless you know what you are doing. Even then YMMV.

That said, you will need to use a [service override](./../config/services.md#overrides) to take advantage of them like so:

```yaml
my-service:
  type: phpmyadmin
  hosts:
    - database
  overrides:
    environment:
      PMA_ARBITRARY: when set to 1 connection to the arbitrary server will be allowed
      PMA_HOST: define address/host name of the MySQL server
      PMA_VERBOSE: define verbose name of the MySQL server
      PMA_PORT: define port of the MySQL server
      PMA_HOSTS: define comma separated list of address/host names of the MySQL servers
      PMA_VERBOSES: define comma separated list of verbose names of the MySQL servers
      PMA_USER: define username to use for config authentication method
      PMA_PASSWORD: define password to use for config authentication method
      PMA_ABSOLUTE_URI: define user-facing URI
```

## Getting information

You can get connection and credential information about your phpmyadmin instance by running [`lando info`](./../cli/info.md). It may also be worth checking out our [accessing services externally guide](./../guides/external-access.md).
