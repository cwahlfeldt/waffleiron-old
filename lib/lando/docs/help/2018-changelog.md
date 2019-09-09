# 2018

## v3.0.0-rc.1 - [September 11, 2018](https://github.com/lando/lando/releases/tag/v3.0.0-rc.1)

**WHILE WE'VE TRIED TO MAINTAIN BACKWARDS COMPATIBILITY WE RECOMMEND YOU [CHECK OUT THE BIG CHANGES](https://docs.devwithlando.io) IN RC! ALSO NOTE THAT THIS VERSION IS STILL IN PRERELEASE WHICH MEANS YOU SHOULD ONLY TRY IT OUT IF YOU ARE FEELING INTREPID**

If you are upgrading from pre-beta.40 follow the [beta.41 release note instructions](https://github.com/lando/lando/releases/tag/v3.0.0-beta.41) If you are on beta.41 or above you can follow the usual JUST-RUN-THE-INSTALLER upgrade process.

**ALSO, STILL, SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Added CA support for custom `proxyDomains` [#998](https://github.com/lando/lando/issues/998)
* Added build steps that can run `before` an app starts [#822](https://github.com/lando/lando/issues/822)
* Added new functional testing toolkit [#1144](https://github.com/lando/lando/issues/1144)
* Added 100% unit test coverage of core libraries [#978](https://github.com/lando/lando/issues/978)
* Added 50% unit test coverage of plugins [#1036](https://github.com/lando/lando/issues/1036)
* Added multi-service and multi-line options for `tooling` [#1036](https://github.com/lando/lando/issues/1036)
* Changed build process to be more stable and reliable [#822](https://github.com/lando/lando/issues/822)
* Changed `restart` to not invoke any build steps [#1064](https://github.com/lando/lando/issues/1064) [#963](https://github.com/lando/lando/issues/963)
* Eliminated technical debt for core libraries [#1036](https://github.com/lando/lando/issues/1036)
* Fixed `freetype` support on `php-5.3-fpm` [#1141](https://github.com/lando/lando/issues/1141)
* Fixed `pre-` event steps [#822](https://github.com/lando/lando/issues/822)
* Fixed various bugs relating to networks and certs [#1071](https://github.com/lando/lando/issues/1071)
* Fixed build steps and events to ensure internal deps are installed first [#1021](https://github.com/lando/lando/issues/1021)
* Reduced technical debt for plugins [#1036](https://github.com/lando/lando/issues/1036)
* Switched code to `es6` [#1036](https://github.com/lando/lando/issues/1036)
* Updated our `examples` to be func testing compatible [#1144](https://github.com/lando/lando/issues/1144)
* Updated to latest Docker deps [#1148](https://github.com/lando/lando/issues/1148)

## v3.0.0-beta.47 - [June 1, 2018](https://github.com/lando/lando/releases/tag/v3.0.0-beta.47)

If you are upgrading from pre-beta.40 follow the [beta.41 release note instructions](https://github.com/lando/lando/releases/tag/v3.0.0-beta.41) If you are on beta.41 or above you can follow the usual JUST-RUN-THE-INSTALLER upgrade process.

**ALSO, STILL, SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Fixed various show-stopping Windows bugs [#1004](https://github.com/lando/lando/issues/1004)

## v3.0.0-beta.46 - [May 27, 2018](https://github.com/lando/lando/releases/tag/v3.0.0-beta.46)

If you are upgrading from pre-beta.40 follow the [beta.41 release note instructions](https://github.com/lando/lando/releases/tag/v3.0.0-beta.41) If you are on beta.41 or above you can follow the usual JUST-RUN-THE-INSTALLER upgrade process.

**ALSO, STILL, SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Fixed bug that was throwing `ERROR: The Compose file is invalid...` when `proxy` service changed [#942](https://github.com/lando/lando/issues/942)
* Fixed bug where the `rsync` option was not overrideable for `lando pull` [#982](https://github.com/lando/lando/issues/982)
* Fixed bug where any `--` global options were resetting overriden option defaults [#982](https://github.com/lando/lando/issues/982)
* Fixed bug where `pull` component of `lando rebuild` was ignoring `-s` option [#952](https://github.com/lando/lando/issues/952)
* Fixed bug causing `network XXX not found` error [#990](https://github.com/lando/lando/issues/990)
* Improved `pantheon` pre-run scripting with better perm handling and `$HOME` support [#975](https://github.com/lando/lando/issues/975)
* Improved custom `build` and `volumes` overrides to handle absolute and relative paths [#950](https://github.com/lando/lando/issues/950)

## v3.0.0-beta.45 - [May 16, 2018](https://github.com/lando/lando/releases/tag/v3.0.0-beta.45)

If you are upgrading from pre-beta.40 follow the [beta.41 release note instructions](https://github.com/lando/lando/releases/tag/v3.0.0-beta.41) If you are on beta.41 or above you can follow the usual JUST-RUN-THE-INSTALLER upgrade process.

**ALSO, STILL, SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Added `curl` and `php-curl` to `php 5.3` Apache image [#882](https://github.com/lando/lando/issues/882)
* Added support for `postgres` to `lando db-import` and `lando db-export` [#803](https://github.com/lando/lando/issues/803)
* Added support for a `compose` service type. [#933](https://github.com/lando/lando/issues/933)
* Added documentation on using patch versions of images where applicable [#890](https://github.com/lando/lando/issues/890)
* Deprecated `DB_*` and `CACHE_*` environment variables in favor of `LANDO_INFO` [#868](https://github.com/lando/lando/issues/868)
* Fixed bug that prevented usage of overriden `Dockerfiles` [#740](https://github.com/lando/lando/issues/740)
* Improved remote Docker handling [#647](https://github.com/lando/lando/issues/647)
* Improved handling of `mysql` and `pgsql` commands [#803](https://github.com/lando/lando/issues/803)
* Improved detection of non-standard `docker` and `docker-compose` binaries on Linux [#935](https://github.com/lando/lando/issues/935)
* Improved `drush` usage documentation [#580](https://github.com/lando/lando/issues/580)
* Improved `drupal 7/8` image styles when using language code in URL [#914](https://github.com/lando/lando/issues/914)
* Improved `lando ssh` so it honors the current working directory [#895](https://github.com/lando/lando/issues/895)
* Improved `lando ssh` so it fallsback to `sh` if `bash` is not available [#895](https://github.com/lando/lando/issues/895)
* Injected `APP_LOG=errorlog` for Laravel recipes [#958](https://github.com/lando/lando/issues/958)
* Removed legacy `php_value xdebug.remote_autostart 1` being set in the `php` `httpd-ssl.conf` [#886](https://github.com/lando/lando/issues/886)
* Switched `pantheon` `drupal8` sites to globally install `Drush 8` by default [#580](https://github.com/lando/lando/issues/580)
* Moved `prestissimo` from build step to image [#882](https://github.com/lando/lando/issues/882)
* Updated legacy Pantheon API endpoints [#953](https://github.com/lando/lando/issues/953)

## v3.0.0-beta.44 - [May 4, 2018](https://github.com/lando/lando/releases/tag/v3.0.0-beta.44)

**THIS IS A HOTFIX RELEASE DUE TO BREAKING UPSTREAM CHANGES**

If you are upgrading from pre-beta.40 follow the [beta.41 release note instructions](https://github.com/lando/lando/releases/tag/v3.0.0-beta.41) If you are on beta.41 or above you can follow the usual upgrade process.

**ALSO, STILL, SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Fixed bad id issue interacting with Pantheon API [#943](https://github.com/lando/lando/issues/943)

## v3.0.0-beta.43 - [May 2, 2018](https://github.com/lando/lando/releases/tag/v3.0.0-beta.43)

**THIS IS A HOTFIX RELEASE DUE TO BREAKING UPSTREAM CHANGES**

If you are upgrading from pre-beta.40 follow the [beta.41 release note instructions](https://github.com/lando/lando/releases/tag/v3.0.0-beta.41) If you are on beta.41 or above you can follow the usual upgrade process.

**ALSO, STILL, SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Fixed nasty bug where user sites were returning "undefined" [#922](https://github.com/lando/lando/issues/922)
* Fixed "Named volume "$LANDO_ENGINE_CONF:/lando:rw" issue [#927](https://github.com/lando/lando/issues/927)

## v3.0.0-beta.42 - [April 30, 2018](https://github.com/lando/lando/releases/tag/v3.0.0-beta.42)

**THIS IS A HOTFIX RELEASE DUE TO BREAKING UPSTREAM CHANGES**

If you are upgrading from pre-beta.40 follow the [beta.41 release note instructions](https://github.com/lando/lando/releases/tag/v3.0.0-beta.41) If you are on beta.41 or above you can follow the usual upgrade process.

**ALSO, STILL, SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Set default service versions [#908](https://github.com/lando/lando/issues/908)
* Convert interactive name parameters to machine safe [#891](https://github.com/lando/lando/issues/891)

## v3.0.0-beta.41 - [April 30, 2018](https://github.com/lando/lando/releases/tag/v3.0.0-beta.41)

**THIS IS A HOTFIX RELEASE DUE TO BREAKING UPSTREAM CHANGES**

If you are upgrading from pre-beta.40 it is recommended (although possibly not necessary) for you to:

1. Uninstall Docker **(only if you are using Docker for Mac or Docker for Windows)**

**PLEASE NOTE THAT THIS WILL DESTROY ALL YOUR LOCAL APPS!!!**

2. Remove the Lando config directory at `~/.lando`
3. Install the new Lando

**ALSO, STILL, SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Set default service versions [#908](https://github.com/lando/lando/issues/908)
* Convert interactive name parameters to machine safe [#891](https://github.com/lando/lando/issues/891)

## v3.0.0-beta.40 - [April 8, 2018](https://github.com/lando/lando/releases/tag/v3.0.0-beta.40)

**SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Added Arch-based distro pacman package build support [#814](https://github.com/lando/lando/issues/814)
* Added Prestissimo to all PHP services [#62](https://github.com/lando/lando/issues/862)
* Added $LANDO_INFO so every service has information about every other service [#727](https://github.com/lando/lando/issues/727)
* Correct licence used when packaging application
* Fixed bug in app names containing `_|-|.` [#697](https://github.com/lando/lando/issues/697)
* Fixed bug in app names containing uppercase letters [#829](https://github.com/lando/lando/issues/829)
* Fixed various bugs related to database credential overrides [#853](https://github.com/lando/lando/issues/853)
* Fixed various bugs related to `db-import/export` on additional database services [#853](https://github.com/lando/lando/issues/853)
* Signed all container certs with new Lando Local CA [#446](https://github.com/lando/lando/issues/446)
* Updated `terminus` to version `1.8.0` [#848](https://github.com/lando/lando/issues/848)

## v3.0.0-beta.39 - [March 30, 2018](https://github.com/lando/lando/releases/tag/v3.0.0-beta.39)

**WE HIGHLY RECOMMEND YOU UPDATE TO THIS VERSION!!!**

**SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Fixed bug where `linux` `LANDO_ENGINE_REMOTE_IP` was not set to detected IP
* Updated problematic Docker for Mac 59 to Docker for Mac 60

## v3.0.0-beta.38 - [March 29, 2018](https://github.com/lando/lando/releases/tag/v3.0.0-beta.38)

**WE HIGHLY RECOMMEND YOU UPDATE TO THIS VERSION!!!**

**SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Added better support for internal resolution of `proxy` domains
* Added `COMPOSE_CONVERT_WINDOWS_PATHS` on Windows to help mitigate known Docker for Windows bug [#823](https://github.com/lando/lando/issues/823)
* Changed healthcheck retries to numbers per Compose file format [#796](https://github.com/lando/lando/issues/796)
* Fixed new networking layer to alleviate multi-app-running "weirdness" [#640](https://github.com/lando/lando/issues/640)
* Fixed intermittent permission borking for Linux users using alpine-based services [#795](https://github.com/lando/lando/issues/795)
* Improved `linux` Docker start command handling [#659](https://github.com/lando/lando/issues/659)
* Improved handling and documentation of upload issues on Windows [#396](https://github.com/lando/lando/issues/396)
* Improved and simplified our examples [#798](https://github.com/lando/lando/issues/798) [#801](https://github.com/lando/lando/issues/801)
* Switched to use new `host.docker.internal` for host resolution from container.

## v3.0.0-beta.37 - [March 20, 2018](https://github.com/lando/lando/releases/tag/v3.0.0-beta.37)

**THIS RELEASE CONTAINS SIGNIFICANT CODE REFACTORING TO HELP WITH TESTING. YOU MAY WANT TO HOLD OFF FOR A FEW VERSIONS IF YOU WANT TO BE SUPER SAFE ABOUT THINGS!**

**BUT IF YOU"RE AWESOME AND WANT TO HELP US, USE IT AND BREAK IT AND SUBMIT ISSUES.** If you do experience any issues try the following corrective action first:

  1. `lando rebuild` any failing apps
  2. `lando destroy` and then `lando start` any failing apps
  3. Restart the docker daemon
  4. Restart your computer
  5. `docker rm -f CONTAINER_ID` any containers throwing errors
  6. Reset the docker daemon to factory defaults (this will blow up all your containers)
  7. Submit an issue to GitHub
  8. Revert to [beta.35](https://github.com/lando/lando/releases/tag/v3.0.0-beta.35) :(

**ALSO, STILL, SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Added `run` and `run_as_root` as the preferred build step keys [#745](https://github.com/lando/lando/issues/745)
* Added `run_internal` and `run_as_root_internal` for `lando` to use for programmatic build steps [#745](https://github.com/lando/lando/issues/745)
* Added some functional tests to get us moving on testing [#675](https://github.com/lando/lando/issues/675)
* Added legitimate cross-project service networking [#640](https://github.com/lando/lando/issues/640)
* Added `postgresql-client` to `php` images [#717](https://github.com/lando/lando/issues/717)
* Broadened scope of build step re-run to increase start stability [#683](https://github.com/lando/lando/issues/683)
* Changed default interactive `yes/no` prompts to `no` [#669](https://github.com/lando/lando/issues/669)
* Changed `proxy` to be less aggressive on `docker` restarts [#761](https://github.com/lando/lando/issues/761)
* Documented common `.lando.yml` syntax more explicitly [#643](https://github.com/lando/lando/issues/643)
* Finally moved over to all the `eslint` [#620](https://github.com/lando/lando/issues/620)
* Fixed bug where offline mode was failing on metrics check [#630](https://github.com/lando/lando/issues/630)
* Fixed bug where `php 5.3 apache` was not starting correctly [#652](https://github.com/lando/lando/issues/652)
* Fixed GitHub API rate limit bug [#598](https://github.com/lando/lando/issues/598)
* Fixed `postgres` persistent storage and config loading [#39](https://github.com/lando/lando/issues/39)
* Fixed bug where `lando pull` fails to replace wordpress URLs in db [#711](https://github.com/lando/lando/issues/711)
* Improved build step failure UX [#683](https://github.com/lando/lando/issues/683)
* Improved speed of `lando init METHOD` driven `git clone` [#178](https://github.com/lando/lando/issues/178)
* Improved overriding of global config through envvars [#647](https://github.com/lando/lando/issues/647)
* Improved `lando start` so it wait for services that need a `healthcheck` [#677](https://github.com/lando/lando/issues/677)
* Improved default `php` `sendmail` behavior [#756](https://github.com/lando/lando/issues/756)
* Provided some corrective action around `proxy` start failures [#632](https://github.com/lando/lando/issues/632)
* Refactored the code to increase testibility and reduce complexity and dependents [#620](https://github.com/lando/lando/issues/620)
* Removed `disableAutoComposerInstall` and `pantheon` recipe auto `composer install` [#501](https://github.com/lando/lando/issues/501)
* Removed dependency on `grunt` [#639](https://github.com/lando/lando/issues/639)
* Switched to all the `yarn` [#639](https://github.com/lando/lando/issues/639)
* Updated `drush launcher` to version `0.5.1` [#666](https://github.com/lando/lando/issues/666)
* Updated docs to reflect new refactor, dx and governance. [#685](https://github.com/lando/lando/issues/685)
* Updated `terminus` to version `1.7.1`

## v3.0.0-beta.35 - [January 8, 2018](https://github.com/lando/lando/releases/tag/v3.0.0-beta.35)

**SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Fixed bug in URL scanning where no color was specified for caught errors [#627](https://github.com/lando/lando/issues/627)
* Fixed bug in URL scanning where wilcard domains were unintentionally being scanned [#627](https://github.com/lando/lando/issues/627)
* Fixed bug in Windows where custom `php` config file was being mounted with wrong path separator [#625](https://github.com/lando/lando/issues/625)

## v3.0.0-beta.34 - [January 5, 2018](https://github.com/lando/lando/releases/tag/v3.0.0-beta.34)

**SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Added ability to disable `lando` provided tooling commands [#472](https://github.com/lando/lando/issues/472)
* Added support for `php` `7.2` to Pantheon recipes
* Added support for wildcard proxy domains [#618](https://github.com/lando/lando/issues/618)
* Fixed bug preventing usage of `--dest` flag in `lando init`s [#584](https://github.com/lando/lando/issues/584)
* Fixed bug where `cli` containers were reporting not existing on first run [#586](https://github.com/lando/lando/issues/586)
* Fixed bug where `cli` containers were not inheriting overrides [#586](https://github.com/lando/lando/issues/586)
* Fixed annoying permissions bug on non-root run services on Linux [#437](https://github.com/lando/lando/issues/437)
* Fixed bug where build steps ignored `-s` flag on `lando rebuild` [#596](https://github.com/lando/lando/issues/596)
* Improved handling of custom `php.ini` files so injection is clearer [#589](https://github.com/lando/lando/issues/589)
* Improved handling of `docker` too-many-networks error [#274](https://github.com/lando/lando/issues/274)

## v3.0.0-beta.33 - [January 4, 2018](https://github.com/lando/lando/releases/tag/v3.0.0-beta.33)

**SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Fixed a bug where Pantheon recipes were erroring on no `solr` user [#611](https://github.com/lando/lando/issues/611)

## v3.0.0-beta.32 - [January 4, 2018](https://github.com/lando/lando/releases/tag/v3.0.0-beta.32)

**SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Added some small changes needed by Pantheon Localdev
* Added a Tomcat service [#568](https://github.com/lando/lando/issues/568)
* Added `known_hosts` mapping [#601](https://github.com/lando/lando/issues/601)
* Added support for `php` `7.2` [#578](https://github.com/lando/lando/issues/578)
* Fixed nasty custom `solr` conf bug [#551](https://github.com/lando/lando/issues/551)
* Improved handling of non-standard proxy ports
* Improved feedback to user when the `docker` engine is down [#550](https://github.com/lando/lando/issues/550)
