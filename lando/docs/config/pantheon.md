# Pantheon

[Pantheon](https://pantheon.io) is a web development hosting platform for open-source Drupal and WordPress websites. It is an app-specific PaaS provider, sold on a monthly subscription basis, with several support tiers available.

Lando provides a snazy integration that

* Closely mimics Pantheon's [stack, versions](https://pantheon.io/docs/platform/) and [environment](https://pantheon.io/docs/read-environment-config/) locally
* Allows you to easily `pull` your Pantheon site down locally
* Allows you to easily `push` your changes back to Pantheon
* Installs `drush`, `terminus` and other power tools.

However, in order to profit **you must** have an account and a site on Pantheon to be able to use this recipe. If you don't you can sign up [here](https://pantheon.io/register).

You should also check out Pantheon's [local dev](https://pantheon.io/docs/local-development/) docs.

[[toc]]

## Getting Started

Before you get started with this recipe we assume that you have:

1. [Installed Lando](./../basics/installation.md) and gotten familar with [its basics](./../basics/)
2. [Initialized](./../basics/init.md) a [Landofile](./../config/lando.md) for your codebase for use with this recipe
3. Read about the various [services](./../config/services.md), [tooling](./../config/tooling.md), [events](./../config/events.md) and [routing](./../config/proxy.md) Lando offers.

However, because you are a developer and developers never ever [RTFM](https://en.wikipedia.org/wiki/RTFM) you can also run the following commands to try out this recipe with a vanilla install of WordPress.

```bash
# Go through interactive prompts to get your site from pantheon
lando init --source pantheon

# OR do it non-interactively
lando init \
  --source pantheon \
  --pantheon-auth "$PANTHEON_MACHINE_TOKEN" \
  --pantheon-site "$PANTEHON_SITE_NAME"

# Start it up
lando start

# Import your database and files
lando pull

# List information about this app.
lando info
```

## Configuration

While Lando [recipes](./../config/recipes.md) set sane defaults so they work out of the box they are also [configurable](./../config/recipes.md#config).

Here are the configuration options, set to the default values, for this recipe. If you are unsure about where this goes or what this means we *highly recommend* scanning the [recipes documentation](./../config/recipes.md) to get a good handle on how the magicks work.

```yaml
recipe: pantheon
config:
  framework: PANTHEON_SITE_FRAMEWORK
  id: PANTHEON_SITE_ID
  site: PANTHEON_SITE_MACHINE_NAME
  xdebug: false
  index: true
  edge: true
  cache: true
```

If you do not already have a [Landofile](./../config/lando.md) for your Pantheon site we highly recommend you use [`lando init`](./../basics/init.md) to get one as that will automatically populate the `framework`, `id` and `site` for you. Manually creating a Landofile with these things set correctly can be difficult and is *highly discouraged.*

Note that if the above config options are not enough all Lando recipes can be further [extended and overriden](./../config/recipes.md#extending-and-overriding-recipes).

### Choosing a php version

Lando will look for a [`pantheon.yml`](https://pantheon.io/docs/pantheon-yml/) (and/or `pantheon.upstream.yml`) in your app's root directory and use whatever `php_version` you've specified there.

This means that **you can not configure the php version directly in your Landofile for this recipe.**

If you change this version make sure you [`lando rebuild`](./../cli/rebuild.md) for the changes to apply.

**Example pantheon.yml**

```yaml
api_version: 1
php_version: 7.1
```

### Choosing a nested webroot

Lando will look for a [`pantheon.yml`](https://pantheon.io/docs/pantheon-yml/) (and/or `pantheon.upstream.yml`) in your app's root directory and use whatever `web_docroot` you've specified there.

This means that **you can not configure the webroot directly in your Landofile for this recipe.**

If you change this version make sure you [`lando rebuild`](./../cli/rebuild.md) for the changes to apply.

**Example pantheon.yml**

```yaml
api_version: 1
web_docroot: true
```

### Customizing the stack

By default Lando will spin up a **very close** approximation of the Pantheon stack

* [php appserver served by nginx](https://pantheon.io/docs/application-containers/)
* [mariadb database](https://pantheon.io/blog/using-mariadb-mysql-replacement)
* [redis cache](https://pantheon.io/docs/redis/)
* [solr index](https://pantheon.io/docs/solr/)
* [varnish edge](https://pantheon.io/docs/caching-advanced-topics/)

Please review the following docs to get a better handle on [how Pantheon works](https://pantheon.io/how-it-works):

*   [Pantheon Edge and Varnish](https://pantheon.io/docs/varnish/)
*   [Pantheon Index and Solr](https://pantheon.io/docs/solr/)
*   [Pantheon Caching and Redis](https://pantheon.io/docs/redis/)

What works on Pantheon **should** also work on Lando but recognize that the Pantheon platform is changing all the time and Lando is necessarily reactive.

All that said you can, however, tell Lando to *not use* the more advanced parts of Pantheon's stack. This can save time when starting up your app.

```yaml
recipe: pantheon
config:
  framework: PANTHEON_SITE_FRAMEWORK
  id: PANTHEON_SITE_ID
  site: PANTHEON_SITE_MACHINE_NAME
  # Disable the SOLR index
  index: false
  # Disable the VARNISH edge
  edge: false
  # Disable the REDIS cache
  cache: false
```

Note that if your application code depends on one of these services and you disable them you should expect an error. Also note that Lando does not track what services you are using on your Pantheon site eg these settings are "decoupled".

### Using xdebug

This is just a passthrough option to the [xdebug setting](./php.md#toggling-xdebug) that exists on all our [php services](./php.md). The `tl;dr` is `xdebug: true` enables and configures the php xdebug extension and `xdebug: false` disables it.

```yaml
recipe: lamp
config:
  xdebug: true|false
```

However, for more information we recommend you consult the [php service documentation](./php.md).

## Connecting to your database

Just like Pantheon, Lando will automatically configure your application to connect to its local database.

You can also check out the environment variable called [`LANDO INFO`](./../guides/lando-info.md) as it contains useful information about how your application can access other Lando services.

If you find that you still cannot connect to your database, which can happen if a local `wp-config.php` or `settings.local.php` is hijacking our automation the default credentials are below. Note that the `host` is not `localhost` but `database`.

```yaml
database: pantheon
username: pantheon
password: pantheon
host: database
port: 3306
```

You can get also get the above information, and more, by using the [`lando info`](./../cli/info.md) command.

## Importing Your Database and Files

Once you've started up your Pantheon site you will need to pull in your database and files before you can really start to dev all the dev. There are two easy ways to do this...

### 1. Using `lando pull`

Lando provides a command for Pantheon sites called `lando pull` to get your database and files.

**If you do not specify `--code`, `--database` or `--files` then `lando` will use the environment associated with your currently checked out `git branch`.**

On a database pull Lando will attempt to clear the cache of the remote environment (unless it is the live environment) to minimize the size of the import.

Note that if Lando cannot find a [Pantheon machine token](https://pantheon.io/docs/machine-tokens/) associated with your site it will prompt you for one. You can also switch to a different machine token by using the  `--auth` option.

#### Usage

```bash
# Pull the latest code, database and files
# This will pull the environment associated with your currently checked out git branch
lando pull

# Skip a code merge
lando pull --code=none

# Pull only the database from the test environment
lando pull --database=test --files=none

# Pull only the files
lando pull --database=none

# Pull only the latest files without grabbing a files backup
lando pull --database=none --rsync

# Do the above but with different auth
lando pull --auth "$PANTHEON_MACHINE_TOKEN" --database=none --rsync
```

#### Options

```bash
--auth          Pantheon machine token
--clear         Clears the lando tasks cache
--code, -c      The environment from which to pull the code
--database, -d  The environment from which to pull the database
--files, -f     The environment from which to pull the files
--help          Shows lando or delegated command help if applicable
--rsync         Rsync the files, good for subsequent pulls
--verbose, -v   Runs with extra verbosity
```

Please consult the manual import documentation below if this command produces an error.

### 2. Manually Importing Your DB and Files

You will want to the replace `MYSITE` and `MYENV` below with the Pantheon site and environment from which you want to import.

#### Database

```bash
# Remove lingering DB dumps
lando ssh -c "rm -f /app/database.sql.gz"

# Create a new backup of your database
# If you've created a db backup recently this step is not needed.
lando terminus backup:create MYSITE.MYENV --element=db

# Download and import backup of the database
lando terminus backup:get MYSITE.MYENV --element=db --to=/app/database.sql.gz
lando db-import database.sql.gz
```

You can learn more about the `db-import` command [over here](./../guides/db-import.md)

#### Files

```bash
# Remove the DB dump
lando ssh -c "rm -f /tmp/files.sql.gz"

# Create a new backup of your files
# If you've created a files backup recently this step is not needed.
lando terminus backup:create MYSITE.MYENV --element=files

# Download and extract backup of the files
lando terminus backup:get MYSITE.MYENV --element=files --to=/tmp/files.tar.gz
# Import your files
# Please be aware the following paths are not valid if you are using a nested webroot in your Pantheon recipe.

#Drupal
lando ssh -c "mkdir -p /app/sites/default/files"
lando ssh -c "tar -xzvf /tmp/files.tar.gz -C /app/sites/default/files --strip-components 1"

#Backdrop
lando ssh -c "mkdir -p /app/files"
lando ssh -c "tar -xzvf /tmp/files.tar.gz -C /app/files --strip-components 1"

#WordPress
lando ssh -c "mkdir -p /app/wp-content/uploads"
lando ssh -c "tar -xzvf /tmp/files.tar.gz -C /app/wp-content/uploads --strip-components 1"
```

You can alternatively download the backup and manually extract it to the correct location.

## Pushing Your Changes

While a best practices workflow suggests you put all your changes in code and push those changes with `git`, Lando provides a utility comand for `pantheon` recipes called `lando push` that pushes up any code, database or files changes you have made locally.

**By default we set `--database` or `--files` to `none` since this is the suggested best practice**.

Note that if Lando cannot find a [Pantheon machine token](https://pantheon.io/docs/machine-tokens/) associated with your site it will prompt you for one. You can also switch to a different machine token by using the  `--auth` option.


### Usage

```bash
# Push the latest code, database and files
# This will push the environment associated with your currently checked out git branch
lando push

# Push the latest code, database and files with a description of the change
lando push -m "Updated the widget to do awesome thing x"

# Push only the database and code
lando push --files=none

# Push only the files and code
lando push

# Do the above but with different auth
lando push --auth "$PANTHEON_MACHINE_TOKEN" --database=none
```

### Options

```bash
--auth          Pantheon machine token
--clear         Clears the lando tasks cache
--code, -c      The environment to which the code will be pushed
--database, -d  The environment to which the database will be pushed
--files, -f     The environment to which the files will be pushed
--help          Shows lando or delegated command help if applicable
--message, -m   A message describing your change
--verbose, -v   Runs with extra verbosity
```

## Working With Multidev

Pantheon [multidev](https://pantheon.io/docs/multidev/) is a great (and easy) way to kickstart an advanced dev workflow for teams. By default `lando` will pull down your `dev` environment but you can use `lando switch <env>` to switch your local copy over to a Pantheon multidev environment.

### Usage

```bash
# Switch to the env called "feature-1"
lando switch feature-1

# Swtich to the env called "feature-1" but ignore grabbing that env's files and database
# Note that this is basically a glorified `get fetch --all && git checkout BRANCH`
lando switch feature-1 --no-db --no-files
```

### Options

```bash
  --no-db     Do not switch the database
  --no-files  Do not switch the files
```

## Environment

### Environment Variables

Like Pantheon, Lando will also [inject variables](https://pantheon.io/docs/read-environment-config/) into your runtime container so that you have useful information stored about your app. These are stored directly in the environment (eg accessible via [`getenv()`](http://php.net/manual/en/function.getenv.php)), `$_ENV`, `$_SERVER` or as defined `php` constants.

Here is a non-exhuastive list of some of the most commonly used config.

```bash
# Site info
PANTHEON_BINDING: lando
PANTHEON_ENVIRONMENT: lando
PANTHEON_SITE_NAME: Your Pantheon site name
PANTHEON_SITE: Your Panthen UUID
FILEMOUNT: The location of your files directory
DOCROOT: /
FRAMEWORK: Either drupal, drupal8, backdrop, or wordpress
HTTP_X_SSL: ON or undefined
HTTPS: on or undefined

# Cache connection info
CACHE_HOST: cache
CACHE_PASSWORD:
CACHE_PORT: 6379

# DB connection info
DB_HOST: database
DB_PORT: 3306
DB_NAME: pantheon
DB_PASSWORD: pantheon
DB_USER: pantheon

# Index connection info
PANTHEON_INDEX_HOST: index
PANTHEON_INDEX_PORT: 449

# WordPress things
AUTH_KEY: Needed for Wordpress. We set this automatically.
AUTH_SALT: Needed for Wordpress. We set this automatically.
LOGGED_IN_KEY: Needed for Wordpress. We set this automatically.
LOGGED_IN_SALT: Needed for Wordpress. We set this automatically.
NONCE_KEY: Needed for Wordpress. We set this automatically.
NONCE_SALT: Needed for Wordpress. We set this automatically.
SECURE_AUTH_KEY: Needed for Wordpress. We set this automatically.
SECURE_AUTH_SALT: Needed for Wordpress. We set this automatically.

# Drupal/Backdrop things
BACKDROP_SETTINGS: JSON object of Backdrop config and settings.
PRESSFLOW_SETTINGS: JSON object of Drupal config and settings.
DRUPAL_HASH_SALT: Needed for Drupal8. We set this automatically.
```

These are in addition to the [default variables](./../config/env.md#default-environment-variables) that we inject into every container. Note that these can vary based on the choices you make in your recipe config.

**NOTE:** These can vary based on the choices you make in your recipe config.

### External Libraries

Lando also supports the same [external libraries](https://pantheon.io/docs/external-libraries/) as Pantheon so you can use Lando to test code that uses `phantomjs`, `wkhtmltopdf`, `tika` and more.

If you'd like to utilize these libraries as [tooling commands](./../config/tooling.nd) add the below to the `tooling` section of your Landofile.

```yaml
phantomjs:
  service: appserver
  cmd: /srv/bin/phantomjs
wkhtmltopdf:
  service: appserver
  cmd: /srv/bin/wkhtmltopdf
tika:
  service: appserver
  cmd: java -jar /srv/bin/tika-app-1.1.jar
```

## Using Drush

By default our Pantheon recipe will globally install the [latest version of Drush 8](http://docs.drush.org/en/8.x/install/) unless you are running on `php 5.3` in which case we will install the [latest version of Drush 7](http://docs.drush.org/en/7.x/install/). For Backdrop sites we will also install the latest version of [Backdrop Drush](https://github.com/backdrop-contrib/drush).

This means that you should be able to use `lando drush` out of the box. That said, you can [easily change](#configuration) the Drush installation behavior if you so desire.

If you decide to list `drush` as a dependency in your project's `composer.json` then Lando will use that one instead. You should be careful if you use Drush 9 as this is not currently *officially* supported by Pantheon.

### Configuring your root directory

If you are using `web_docroot` in your `pantheon.yml` you will need to remember to `cd` into that directory and run `lando drush` from there. This is because many site-specific `drush` commands will only run correctly if you run `drush` from a directory that also contains a Drupal site.

If you are annoyed by having to `cd` into that directory every time you run a `drush` command you can get around it by [overriding](./../config/tooling.md#overriding) the `drush` tooling command in your [Landofile](./../config/lando.md) so that Drush always runs from your `webroot`.

**Note that hardcoding the `root` like this may have unforseen and bad consequences for some `drush` commands such as `drush scr`.**

```yaml
tooling:
  drush:
    service: appserver
    cmd: drush --root=/app/PATH/TO/WEBROOT
```

### URL Setup

To set up your environment so that commands like `lando drush uli` return the proper URL, you will need to configure Drush in your relevant `settings.php` file.

**Drupal 7**

```php
// Set the base URL for the Drupal site.
$base_url = "http://mysite.lndo.site"
```

**Drupal 8**

```php
$options['uri'] = "http://mysite.lndo.site";
```

## Using Terminus

You should be able to use `terminus` commands in the exact same way by prefixing them with `lando` eg `lando terminus auth:whoami`.

### Terminus Plugins

By default Lando will only install `terminus` proper but you can add [Terminus Plugins](https://pantheon.io/docs/terminus/plugins/directory/) to your Landofile with a [build step](./../config/services.md#build-steps).

You will want to consult the relevant install instructions for each plugin but here is an example that installs the [Terminus Build Tools](https://github.com/pantheon-systems/terminus-build-tools-plugin) plugin.

```yml
services:
  appserver:
    build:
      - /bin/sh -c "mkdir -p ~/.terminus/plugins"
      - /bin/sh -c "composer create-project -d ~/.terminus/plugins pantheon-systems/terminus-build-tools-plugin:~1"
```

## Tooling

Each Lando Pantheon recipe will also ship with the Pantheon toolchain. This means you can use `drush`, `wp-cli` and `terminus` via Lando and avoid mucking up your actual computer trying to manage `php` versions and tooling.

```bash
lando composer          Runs composer commands
lando db-export [file]  Exports database from a database service to a file
lando db-import <file>  Imports a dump file into a database service
lando drush             Runs drush commands
lando drupal            Runs drupal console commands
lando mysql             Drops into a MySQL shell on a database service
lando php               Runs php commands
lando pull              Pull code, database and/or files from Pantheon
lando push              Push code, database and/or files to Pantheon
lando switch            Switch to a different multidev environment
lando terminus          Runs terminus commands
lando version           Displays the lando version
```

**Note that the above commands can differ by your recipes `framework`.** The above are for `framework: drupal8`. We recommend you run `lando` in your app for a complete and up to date listing of your tooling.

```bash
# Login to terminus with a machine token
lando terminus auth:login --machine-token=MYSPECIALTOKEN

# Get a list of wp-cli commands
# Only available for framework: wordpress
lando wp

# Download a dependency with drush
lando drush dl views

# Download a dependency with composer
lando composer config repositories.drupal composer https://packages.drupal.org/8
lando composer require "drupal/search_api_pantheon ~1.0" --prefer-dist

# Download a backdrop dependency
lando drush dl webform
```

You can also run `lando` from inside your app directory for a complete list of commands.
