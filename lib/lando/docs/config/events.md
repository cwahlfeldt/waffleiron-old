# Events

::: tip When should I use events instead of a build step?
Unlike [build steps](./services.md#build-steps) `events` will run **every time** so it is advisable to use them for automating common steps like compiling `sass` before or after your app starts and not installing lower level dependencies like `node modules` or `php extensions`.
:::

Events allow you to automate commands or tasks you might often or always run either `before` or `after` something happens. Generally you can hook into `pre` and `post` events for every part of the [Lando](./../api/lando.md) and [App](./../api/app.md) runtime. At time of writing those events were:

| **LANDO** | **APP** |
| -- | -- |
| [pre-bootstrap-config](./../api/lando.md#event_pre_bootstrap_config) | [pre-destroy](./../api/app.md#event_pre_destroy) |
| [pre-bootstrap-tasks](./../api/lando.md#event_pre_bootstrap_tasks) | [ post-destroy](./../api/app.md#event_post_destroy) |
| [pre-bootstrap-engine](./../api/lando.md#event_pre_bootstrap_engine) | [pre-init](./../api/app.md#event_pre_init) |
| [pre-bootstrap-app](./../api/lando.md#event_pre_bootstrap_app) | [post-init](./../api/app.md#event_post_init) |
| [post-bootstrap-config](./../api/lando.md#event_post_bootstrap_config) | [pre-rebuild](./../api/app.md#event_pre_rebuild) |
| [post-bootstrap-tasks](./../api/lando.md#event_post_bootstrap_tasks) | [post-rebuild](./../api/app.md#event_post_rebuild) |
| [post-bootstrap-engine](./../api/lando.md#event_post_bootstrap_engine) | [pre-restart](./../api/app.md#event_pre_restart) |
| [post-bootstrap-app](./../api/lando.md#event_post_bootstrap_app) | [post-restart](./../api/app.md#event_post_restart) |
| [pre-engine-build](./../api/engine.md#event_pre_engine_build) | [pre-start](./../api/app.md#event_pre_start) |
| [post-engine-build](./../api/engine.md#event_post_engine_build) | [post-start](./../api/app.md#event_post_start) |
| [pre-engine-destroy](./../api/engine.md#event_pre_engine_destroy) | [pre-stop](./../api/app.md#event_pre_stop) |
| [post-engine-destroy](./../api/engine.md#event_post_engine_destroy) | [post-stop](./../api/app.md#event_post_stop) |
| [pre-engine-run](./../api/engine.md#event_pre_engine_run) | [pre-uninstall](./../api/app.md#event_pre_uninstall) |
| [post-engine-run](./../api/engine.md#event_post_engine_run) | [post-uninstall](./../api/app.md#event_post_uninstall) |
| [pre-engine-start](./../api/engine.md#event_pre_engine_start) | []() |
| [post-engine-start](./../api/engine.md#event_post_engine_start) | []() |
| [pre-engine-stop](./../api/engine.md#event_pre_engine_stop) | []() |
| [post-engine-stop](./../api/engine.md#event_post_engine_stop) | []() |

You can also hook into `pre` and `post` events for all [tooling](./tooling.md) commands. For example, the command `lando db-import` should expose `pre-db-import` and `post-db-import`

## Discovering Events

While the above lists are great starting point they may be out of date. You can explicitly discover what events are available by running:

```bash
# Discover hookable events for the `lando start` command
lando start -vvv | grep "Emitting"

# Discover hookable events for the `lando test` command
# NOTE: This assumed you've defined a `test` command in tooling
lando test -vvv | grep "Emitting"
```

Specifically, you need to hook into an event where the service you are running the command against exists and is running.

## Usage

It's fairly straightforward to add events to your [Landofile](./lando.md) using the `events` top level config.

Note that due to the nature of events, eg. automating steps that the _user_ usually runs, all commands are run as "you" and do not have `sudo` or `root` access.

### Default commands

By default, event commands will run on the `appserver` service which **may not exist** if you are not using one of Lando's [recipes](./recipes.md) as a starting point for your Landofile.

```yaml
events:
  pre-start:
    - yarn install
    - echo "I JUST YARNED"
```

An exception for this is events that are based on [tooling](./tooling.md) commands which will use the tooling `service` as the default.

```yaml
events:
  post-thing:
    - some-command
tooling:
  thing:
    service: web
```

In the above scenario, `some-command` will run on the `web` service by default instead of the `appserver`. For [dynamic tooling routes](./tooling.md#dynamic-service-commands) events will use the default of the dynamic route.

```yaml
events:
  post-dynamic:
    - some-command
tooling
  dynamic:
    cmd: env
    service: :host
    options:
      host:
        default: web2
        alias:
          - h
        describe: Run a different service
```

In the above scenario, `some-command` will run on `web2` by default.

### Service commands

While the defaults above are good to know we *highly recommend* you just explicitly define which commands should run on which services by keying the command with a service as below.

```yaml
events:
  pre-start:
    - appserver: composer install
    - database: echo "I JUST COMPOSERED"
  post-start:
    - node: yarn sass
    - appserver: composer compile-templates
```
