# 2017

## v3.0.0-beta.31 - [November 26, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.31)

**SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Added `README`s to our examples [#51](https://github.com/lando/lando/issues/51)
* Give error when trying to run Lando with `sudo` [#545](https://github.com/lando/lando/issues/545)

## v3.0.0-beta.29 - [November 25, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.29)

**SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Added `drush: false` to Drupaly recipes to turn off Lando `drush` handling [#535](https://github.com/lando/lando/issues/535)
* Added `drush: composer` to Drupaly recipes to install Drush Launcher (good for Drupal 8.4+) [#536](https://github.com/lando/lando/issues/536) [#537](https://github.com/lando/lando/issues/537)
* Added drush: path:/PATH to Drupaly recipes to manually specify the Drush path [#542](https://github.com/lando/lando/issues/542)
* Added `apcu` extension for `php` where applicable [#541](https://github.com/lando/lando/issues/541)
* Added `intl` and `gettext` extensions for `php` [#528](https://github.com/lando/lando/issues/528)
* Udpated base images to `jessie` where applicable [#539](https://github.com/lando/lando/issues/539)

## v3.0.0-beta.28 - [November 23, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.28)

**SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* This release is only intended to verify the new update logic [#430](https://github.com/lando/lando/issues/430)

## 3.0.0-beta.27 - [November 23, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.27)

**SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Signed `macOS` package.
* Improved update considerations [#430](https://github.com/lando/lando/issues/430)

## v3.0.0-beta.26 - [November 20, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.26)

**SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Added `solr` `6.6`, `7.0`, `7.1` [#513](https://github.com/lando/lando/issues/513)
* Improved `solr` to inject core specific config as well.
* Improved support for `python` [#444](https://github.com/lando/lando/issues/444)
* Persisted `solr` index data through rebuilds [#59](https://github.com/lando/lando/issues/59)

## v3.0.0-beta.25 - [November 16, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.25)

**THIS RELEASE SHOULD AUTOFIX [#497](https://github.com/lando/lando/issues/497) SEE BULLET BELOW FOR DETAIL**

* `Error: EISDIR: illegal operation on a directory, open '/Users/daniel/.lando/services/config/nginx/fastcgi_params'` error.

**SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Added `HTTP_USER_AGENT_HTTPS` as an `nginx` server var [#423](https://github.com/lando/lando/issues/423)
* Improved `tmp` directory handling for `pantheon` recipes [#481](https://github.com/lando/lando/issues/481)
* Improved handling of botched script/conf file injection [#497](https://github.com/lando/lando/issues/497)

## v3.0.0-beta.24 - [November 14, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.24)

**HOTFIX RELEASE!!!**

**SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Fixed missing nginx conf file

## v3.0.0-beta.23 - [November 14, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.23)

**SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Added ability to add global envvars through `config.yml` [#479](https://github.com/lando/lando/issues/479)
* Added `disableAutoComposerInstall` settings to allow users to disable auto `composer install` on `pantheon` recipe start ops [#464](https://github.com/lando/lando/issues/464)
* Clarified and standarized docs around loading custom config files for `php-y` things [#410](https://github.com/lando/lando/issues/410)
* Improved handling of `HTTPS` server var for `php` things [#486](https://github.com/lando/lando/issues/486)
* Improved handling of custom `php.ini` files so they override better [#410](https://github.com/lando/lando/issues/410)
* Improved `pantheon.yml` and `pantheon.upstream.yml` handling [#453](https://github.com/lando/lando/issues/453)
* Improved Getting Started docs [#326](https://github.com/lando/lando/issues/326)
* Improved Terminus docs [#454](https://github.com/lando/lando/issues/454)
* Increased THREAT LEVEL of malformed `.lando.yml` files [#457](https://github.com/lando/lando/issues/457)
* Removed the deletion of user configuration files for Lando during un-install on Linux and OSX [#470](https://github.com/lando/lando/issues/470)
* Upgraded `terminus` to `1.6.1` for `pantheon` recipes `lando rebuild` required [#487](https://github.com/lando/lando/issues/487)

## v3.0.0-beta.22 - [October 23, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.22)

**SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Added support for `pantheon.upstream.yml` [#425](https://github.com/lando/lando/issues/425)
* Changed default DB and files `lando push` targets to none on Pantheon recipe [#422](https://github.com/lando/lando/issues/422)
* Fixed `drush` compatibility on Backdrop sites using `php 5.3` [#418](https://github.com/lando/lando/issues/418)
* Update Backdrop Drush to `0.0.6`

## v3.0.0-beta.21 - [October 15, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.21)

**SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

**This update contains potentially breaking changes for Windows users!!! Please be mindful of the install prompts.**

* Improved messaging and customization around Windows installer [#398](https://github.com/lando/lando/issues/398)
* Improved `lando pull` for pantheon recipes to not clear caches on live env [#406](https://github.com/lando/lando/issues/406)
* Updated to use new Docker for Windows installer (#thanksdocker) [#405](https://github.com/lando/lando/issues/405)

## v3.0.0-beta.20 - [October 12, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.20)

**SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Added `go` service [#70](https://github.com/lando/lando/issues/70)
* Added `--stdout` flag to `db-export` [#349](https://github.com/lando/lando/issues/349)
* Added ability to pipe data into `db-import` (this is currently finicky) [#349](https://github.com/lando/lando/issues/349)
* Added `memcached` php extension to core php image [#343](https://github.com/lando/lando/issues/343)
* Added `exif` php extension to core php image [#371](https://github.com/lando/lando/issues/371)
* Added info about installed `php` extensions [#343](https://github.com/lando/lando/issues/343)
* Added `--no-wipe` flag to `db-import` to prevent above [#353](https://github.com/lando/lando/issues/353)
* Added documentation on how to use Lando when behind a proxy [#363](https://github.com/lando/lando/issues/363) [#369](https://github.com/lando/lando/issues/369)
* Added machine identifier to Lando-generated ssh keys [#388](https://github.com/lando/lando/issues/388)
* Added global config option `loadPassphraseProtectedKeys` to load passphrase protected keys [#344](https://github.com/lando/lando/issues/344)
* Added Apache Tika to Pantheon recipes [#350](https://github.com/lando/lando/issues/350)
* Switched `db-import` to wipe target DB before import [#353](https://github.com/lando/lando/issues/353)
* Switched Pantheon `lando pull` to purge local DB first before importing remote one [#353](https://github.com/lando/lando/issues/353)
* Switched `drupal8` recipe to install global Drupal Console by default [#381](https://github.com/lando/lando/issues/381)
* Upgraded to `terminus` 1.6.0. [#343](https://github.com/lando/lando/issues/343)
* Fixed bug reporting `manifest for solr:4.10 not found` [#380](https://github.com/lando/lando/issues/380)

## v3.0.0-beta.19 - [October 2, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.19)

**SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Hotfixed regression introduced by [#351](https://github.com/lando/lando/issues/376) that borked `lando` [#376](https://github.com/lando/lando/issues/312)

## v3.0.0-beta.18 - [October 1, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.18)

**SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

* Updated `docs.lndo.io` and `metrics.lndo.io` to `*.devwithlando.io`
* Improved app start to separate `urls` by service [#327](https://github.com/lando/lando/issues/327)
* Switched `lando share` to operate based on `url` instead of `service` [#312](https://github.com/lando/lando/issues/312)
* Provided warning to `macOS` installer regarding Docker installation [#355](https://github.com/lando/lando/issues/355)
* Fixed bug caused by badly formatted `lando share` subdomain [#368](https://github.com/lando/lando/issues/368)
* Fixed bug where `lando CMD` was throwing `arg.match` error when using numbers [#351](https://github.com/lando/lando/issues/351)

## v3.0.0-beta.17 - [September 9, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.17)

**SERIOUSLY, READ THE DOCS!: https://docs.devwithlando.io/**

*  Added ability to run `php` in cli mode [#160](https://github.com/lando/lando/issues/160)
*  Added ability to use `terminus` for `php 5.3` Pantheon apps [#328](https://github.com/lando/lando/issues/328)
*  Added extra check to validate format of injected `ssh` keys [#335](https://github.com/lando/lando/issues/335)
*  Fixed broken `php-fpm 5.3` service [#328](https://github.com/lando/lando/issues/328)

## v3.0.0-beta.16 - [September 5, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.16)

*  Moved from `kalabox` namespace to `lando` namespace.

## v3.0.0-beta.15 - [September 4, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.15)

*  Moved from `kalabox` namespace to `lando` namespace.

## v3.0.0-beta.14 - [September 4, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.14)

**SERIOUSLY, READ THE DOCS: https://docs.devwithlando.io/**

*  Fixed hang when starting Pantheon recipe [#300](https://github.com/lando/lando/issues/300) [#302](https://github.com/lando/lando/issues/302) [#311](https://github.com/lando/lando/issues/311)
*  Fixed issue grabbing files on different branches for Pantheon recipes [#329](https://github.com/lando/lando/issues/329)

## v3.0.0-beta.13 - [September 4, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.13)

**SERIOUSLY, READ THE DOCS: https://docs.devwithlando.io/**

*  Added an `ASP.net` service [#306](https://github.com/lando/lando/issues/306)
*  Added a `MSSQL` service [#320](https://github.com/lando/lando/issues/320)
*  Added `joomla` recipe [#321](https://github.com/lando/lando/issues/321)

## v3.0.0-beta.12 - [September 1, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.12)

**SERIOUSLY, READ THE DOCS: https://docs.devwithlando.io/**

*  Added a `python` service [#69](https://github.com/lando/lando/issues/69)
*  Improved handling of app directories that are deleted before `lando destroy` [#265](https://github.com/lando/lando/issues/265)
*  Pegged `terminus` version in our Dockerfiles to reduce potential of "nasty surprises"
*  Fixed bug where GitHub reported errors were not being checked correctly
*  Fixed "bug" causing SQL imports to fail on single large transactions [#313](https://github.com/lando/lando/issues/313)
*  Fixed bug that required `db-import` dbs to be in same dir as `.lando.yml` [#314](https://github.com/lando/lando/issues/314)

## v3.0.0-beta.11 - [August 27, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.11)

**SERIOUSLY, READ THE DOCS: https://docs.devwithlando.io/**

*  Fixed bug where recipe-set proxy config could not be unset [#295](https://github.com/lando/lando/issues/295)
*  Added `db-export` command and docs. [#292](https://github.com/lando/lando/issues/292)
*  Added new versions to all services where applicable. [#303](https://github.com/lando/lando/issues/303)
*  Added `ruby` service. [#68](https://github.com/lando/lando/issues/68)

## v3.0.0-beta.10 - [August 19, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.10)

### THIS RELEASE CHANGES THE USAGE OF `lando init`

Consult https://docs.devwithlando.io/cli/init.html or run `lando init -- --help` for the usage change.

**ALSO SERIOUSLY, READ THE DOCS: https://docs.devwithlando.io/**

*   Changed `name` from an argument to an option in `lando init` [#276](https://github.com/lando/lando/issues/276)
*   Changed `pantheon` recipe|method so `lando init` auto-sets the app name [#276](https://github.com/lando/lando/issues/276)
*   Changed `github` method so `lando init` auto-sets the app name [#276](https://github.com/lando/lando/issues/276)
*   Added support for `.env` file injection [#281](https://github.com/lando/lando/issues/281)
*   Added **UNOFFICIAL** support for `php 7.1` in Pantheon apps [#278](https://github.com/lando/lando/issues/278)
*   Added some docs on how to use lando in a ci environment [#147](https://github.com/lando/lando/issues/147) [#149](https://github.com/lando/lando/issues/149)
*   Updated `backdrush` version to `0.0.5` for Pantheon apps [#285](https://github.com/lando/lando/issues/285)
*   Improved `lando pull` so no files backup degrades to `rsync` [#277](https://github.com/lando/lando/issues/277)
*   Improved tooling to support string commands [#282](https://github.com/lando/lando/issues/282)
*   Improved bubbling up of correct error code on all `tooling` commands. Helps with things like `travis`
*   Improved UX `lando push` and `lando pull` return terminal color to default after message
*   Fixed bug where app names with `.` in them were silently failing [#283](https://github.com/lando/lando/issues/283)
*   Fixed regression that caused machine token to not be saved correctly.

## v3.0.0-beta.9 - [August 18, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.9)

### THIS RELEASE CHANGES THE USAGE OF `lando init`

Consult https://docs.devwithlando.io/cli/init.html or run `lando init -- --help` for the usage change.

**ALSO SERIOUSLY, READ THE DOCS: https://docs.devwithlando.io/**

*   Changed `name` from an argument to an option in `lando init` [#276](https://github.com/lando/lando/issues/276)
*   Changed `pantheon` recipe|method so `lando init` auto-sets the app name [#276](https://github.com/lando/lando/issues/276)
*   Changed `github` method so `lando init` auto-sets the app name [#276](https://github.com/lando/lando/issues/276)
*   Added support for `.env` file injection [#281](https://github.com/lando/lando/issues/281)
*   Added **UNOFFICIAL** support for `php 7.1` in Pantheon apps [#278](https://github.com/lando/lando/issues/278)
*   Added some docs on how to use lando in a ci environment [#147](https://github.com/lando/lando/issues/147) [#149](https://github.com/lando/lando/issues/149)
*   Updated `backdrush` version to `0.0.5` for Pantheon apps [#285](https://github.com/lando/lando/issues/285)
*   Improved `lando pull` so no files backup degrades to `rsync` [#277](https://github.com/lando/lando/issues/277)
*   Improved tooling to support string commands [#282](https://github.com/lando/lando/issues/282)
*   Improved bubbling up of correct error code on all `tooling` commands. Helps with things like `travis`
*   Improved UX `lando push` and `lando pull` return terminal color to default after message
*   Fixed bug where app names with `.` in them were silently failing [#283](https://github.com/lando/lando/issues/283)

## v3.0.0-beta.8 - [August 10, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.8)

### THIS RELEASE HAS BREAKING API CHANGES

If you are upgrading and encounter issues try doing a `lando rebuild` on your app. If that does not work try doing a `lando destroy` on your app and then try recreating.

**SERIOUSLY, READ THE DOCS: https://docs.devwithlando.io/**

*   Improved `node` service so you have a decoupled `cli` container [#267](https://github.com/lando/lando/issues/267)
*   Changed `tooling` to run on the `engine` instead of the `app` level [#267](https://github.com/lando/lando/issues/267)
*   Added `needs` options to `tooling` to boot up dependent services [#267](https://github.com/lando/lando/issues/267)
*   Moved proxy dashboard to lesser used port `58086`
*   Fixed `@cleanurl` fails in `pantheon` nginx config. [#266](https://github.com/lando/lando/issues/266)
*   Fixed bug where some simultaneous uses of `proxy` and `init` caused errors [#259](https://github.com/lando/lando/issues/259)
*   Fixed bug where `load-keys` was not filtering out non-keys [#268](https://github.com/lando/lando/issues/268)
*   Fixed bugs in `lando init` handling
*   Fixed bug where `pantheon` machine token was barfing on `lando start` when passed in as option
*   Fixed bug where `pantheon` `lando push` was not asking for a message [#260](https://github.com/lando/lando/issues/260)
*   Fixed bug where `pantheon` `lando push/pull` was not using the right environments [#261](https://github.com/lando/lando/issues/261)
*   Fixed bugs with using `pantheon` site without using `lando init` [#269](https://github.com/lando/lando/issues/269)

## v3.0.0-beta.7 - [August 4, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.7)

*   Fixed URL unknowns

## v3.0.0-beta.6 - [August 3, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.6)

*   Added `lando switch` command to handle `pantheon` multidev [#241](https://github.com/lando/lando/issues/241)
*   Added `interactivity` to `pantheon` utility commands [#249](https://github.com/lando/lando/issues/249)
*   Added `hhvm` option to `php` [#67](https://github.com/lando/lando/issues/67)
*   Added `mongo` service. [#54](https://github.com/lando/lando/issues/54)
*   Added `mean` recipe. [#54](https://github.com/lando/lando/issues/54)

## v3.0.0-beta.5 - [August 2, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.5)

*   Made `lando pull` more robust for Pantheon recipes [#240](https://github.com/lando/lando/issues/240)
*   Added `lando push` command for `pantheon` recipes [#239](https://github.com/lando/lando/issues/239)
*   Fixed brittle remote host determination [#231](https://github.com/lando/lando/issues/231)

## v3.0.0-beta.4 - [August 1, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.4)

*   Improved addition of `sudoers` to `docker` group
*   Fixed incorrect assertion that `drush alias` does not exist during `lando pull` [#240](https://github.com/lando/lando/issues/240)

## v3.0.0-beta.3 - [July 31, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.3)

*   Fixed critical `localtunnel` not found bug.

## v3.0.0-beta.2 - [July 31, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.2)

*   Added the `events` framework [#242](https://github.com/lando/lando/issues/242)
*   Added a `lando share` command to share your local site publicly [#84](https://github.com/lando/lando/issues/84)
*   Fixed build step "merge" to concatenate [#228](https://github.com/lando/lando/issues/228)
*   Fixed `lando init` to rebase on preexisting `.lando.yml` [#243](https://github.com/lando/lando/issues/243)

## v3.0.0-beta.1 - [July 30, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-beta.1)

*   Updated `GitHub` issue template [#137](https://github.com/lando/lando/issues/137)
*   Added option to rebuild specific services on a `lando rebuild` [#223](https://github.com/lando/lando/issues/223)
*   Improved cli feedback for unknown commands [#162](https://github.com/lando/lando/issues/162)
*   Fixed regresion causing custom `extra_hosts` not to load [#222](https://github.com/lando/lando/issues/222)
*   Fixed proxy `extra_hosts` not working on `linux` [#221](https://github.com/lando/lando/issues/221)
*   Fixed `xdebug` not working on `linux` [#231](https://github.com/lando/lando/issues/231)

## v3.0.0-alpha.19 - [July 29, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-alpha.19)

*   Revamped the docs to prep for `beta.1` [#139](https://github.com/lando/lando/issues/139)
*   Provided option handling for `tooling` routes [#141](https://github.com/lando/lando/issues/141)
*   Added `mysql-import` helper [#140](https://github.com/lando/lando/issues/140)
*   Added Pantheon `pull` helper [#142](https://github.com/lando/lando/issues/142)
*   Added `pv` to all `php` images [#140](https://github.com/lando/lando/issues/140)
*   Removed kalabox legacy `path2bind4u`, should allow non `C:\` drive apps on `Win32`
*   Removed kalabox legacy desktop icon on `Win32` [#229](https://github.com/lando/lando/issues/229)
*   Switched default `lando ssh` user from `root` to `you`
*   Fixed broken `php:5.3-apache` because @uberhacker is the best :)

## v3.0.0-alpha.18 - [July 22, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-alpha.18)

*   Bumped binary to use `node8`, gives a nice 33% CLI speed improvement
*   Removed references to needing to set up shared drives on `win32`, this happens on demand now [#219](https://github.com/lando/lando/issues/219)
*   Moved `/usr/local/bin` `chown` setting up the start up stack. [#184](https://github.com/lando/lando/issues/184)
*   "Fixed" hyper annoying `exec` hang bug on `win32` with `docker-compose exec` shellout workaround [#181](https://github.com/lando/lando/issues/181)
*   "Fixed" read provided better handing for `user 33 doesn't exist` race condition [#184](https://github.com/lando/lando/issues/184)

## v3.0.0-alpha.17 - [July 19, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-alpha.17)

*   Made sure `/srv/includes/pantheon.sh` is executable.

## v3.0.0-alpha.16 - [July 19, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-alpha.16)

*   Ensured auto-creation of `/user/.lando/keys`

## v3.0.0-alpha.15 - [July 19, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-alpha.15)

*   Fixed bug where wrong `LANDO_ENGINE_REMOTE_IP` was borking `extra_hosts` [#129](https://github.com/lando/lando/issues/129)
*   Fixed some lingering permissions errors [#129](https://github.com/lando/lando/issues/129) [#163](https://github.com/lando/lando/issues/163) [#177](https://github.com/lando/lando/issues/177)

## v3.0.0-alpha.14 - [July 18, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-alpha.14)

*   Updated documentation [#130](https://github.com/lando/lando/issues/130)
*   Added `mailhog` service [#64](https://github.com/lando/lando/issues/64)
*   Added `elasticearch` service [#16](https://github.com/lando/lando/issues/16)
*   Added support for php `5.4` [#136](https://github.com/lando/lando/issues/136)
*   Added `lando init` docs link [#155](https://github.com/lando/lando/issues/155)
*   Switched `hipache` to `traefik` for proxying. [#169](https://github.com/lando/lando/issues/169)
*   Fixed bug where services could not `curl` themselves with `proxy` domains eg `*.lndo.site` [#154](https://github.com/lando/lando/issues/154)
*   Fixed bug causing directly loaded compose files to fail URL scan. [#169](https://github.com/lando/lando/issues/169)
*   Fixed bug where default php version for `pantheon` recipe was delegated to downstream [#132](https://github.com/lando/lando/issues/132)
*   Fixed bug where Lando was not delegating `--help` correctly [#131](https://github.com/lando/lando/issues/131)
*   Fixed bug where `lando ssh` was not dumping user into `$LANDO_MOUNT` [#159](https://github.com/lando/lando/issues/159)

## v3.0.0-alpha.13 - [June 29, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-alpha.13)

*   Fixed `util` container scripts to be set to executable
*   Fixed regression where `scripts` lost executability
*   Fixed bug where `init` method permissions were stopping `ssh-keygen` on `linux`
*   Tweaked `init` permission handling on `windoze`
*   Fixed persistent cache fail on `windoze`
*   Updated `linux` to use `docker-compose` `1.14.0`
*   Included `routes.json` in executable
*   Fixed bug where `lando init mysite github --recipe pantheon` was not giving Pantheon options
*   Removed `unison` file sharing in favor of `osxfs`. Requires `Docker for Mac 17.04+`. [#41](https://github.com/lando/lando/issues/41)
*   Added `phpmyadmin` service. [#66](https://github.com/lando/lando/issues/66)
*   Fixed bug where multiple DBs on the same app were sharing the same data volume. [#66](https://github.com/lando/lando/issues/66)
*   Added undocumented `LANDO_NO_SCRIPTS` envvar to handle alpine containers that cannot handle auto-script running. [#66](https://github.com/lando/lando/issues/66)
*   Fixed a bug where not specifying a `site` in the `config` for a `pantheon` recipe would throw an error.
*   Improved handling around loading and dumping of YAML files.
*   Added auto SSH key forwarding. [#63](https://github.com/lando/lando/issues/63)
*   Added `lando init` command. [#110](https://github.com/lando/lando/issues/110)
*   Added `pantheon` init method. [#110](https://github.com/lando/lando/issues/110)
*   Added `github` init method. [#110](https://github.com/lando/lando/issues/110)

## v3.0.0-alpha.12 - [June 28, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-alpha.12)

*   Fixed regression where `scripts` lost executability

## v3.0.0-alpha.11 - [June 28, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-alpha.11)

*   Fixed bug where `init` method permissions were stopping `ssh-keygen` on `linux`
*   Tweaked `init` permission handling on `windoze`
*   Fixed persistent cache fail on `windoze`

## v3.0.0-alpha.10 - [June 28, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-alpha.10)

*   Updated `linux` to use `docker-compose` `1.14.0`
*   Included `routes.json` in executable
*   Fixed bug where `lando init mysite github --recipe pantheon` was not giving Pantheon options

## v3.0.0-alpha.9 - [June 28, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-alpha.9)

*   Removed `unison` file sharing in favor of `osxfs`. Requires `Docker for Mac 17.04+`. [#41](https://github.com/lando/lando/issues/41)
*   Added `phpmyadmin` service. [#66](https://github.com/lando/lando/issues/66)
*   Fixed bug where multiple DBs on the same app were sharing the same data volume. [#66](https://github.com/lando/lando/issues/66)
*   Added undocumented `LANDO_NO_SCRIPTS` envvar to handle alpine containers that cannot handle auto-script running. [#66](https://github.com/lando/lando/issues/66)
*   Fixed a bug where not specifying a `site` in the `config` for a `pantheon` recipe would throw an error.
*   Improved handling around loading and dumping of YAML files.
*   Added auto SSH key forwarding. [#63](https://github.com/lando/lando/issues/63)
*   Added `lando init` command. [#110](https://github.com/lando/lando/issues/110)
*   Added `pantheon` init method. [#110](https://github.com/lando/lando/issues/110)
*   Added `github` init method. [#110](https://github.com/lando/lando/issues/110)

## v3.0.0-alpha.8 - [June 24, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-alpha.8)

*   Fixed `pantheon` recipe not sharing `prepend.php` and `pantheon.vcl` correctly.

## v3.0.0-alpha.7 - [June 24, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-alpha.7)

*   Added `laravel` recipe. [#94](https://github.com/lando/lando/issues/94)
*   Added `pantheon` recipe. [#95](https://github.com/lando/lando/issues/95)
*   Fixed volume mounting bug that was causing no `css` or `js` to show up on `nginx` on `linux`
*   Fixed incorrect `DB_PORT` env for `L{A|E}MP` recipes using `postgres`. [#111](https://github.com/lando/lando/issues/111)

## v3.0.0-alpha.6 - [June 20, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-alpha.6)

*   Switched from `encloseJS` to `pkg`. [#108](https://github.com/lando/lando/issues/108)
*   Added `.gitattributes` to force `LF` checkout of container files. [#108](https://github.com/lando/lando/issues/108)
*   Fixed broken `win32` build. [#108](https://github.com/lando/lando/issues/108)

## v3.0.0-alpha.5 - [June 16, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-alpha.5)

*   Fixed bug where recipe overrides were not being mixed in correctly. [#97](https://github.com/lando/lando/issues/97)
*   Fixed bug where `portforward: true` was not showing the actual port given. [#97](https://github.com/lando/lando/issues/97)
*   Separated `build` from `extras`. [#91](https://github.com/lando/lando/issues/91)
*   Added ability to run arbitrary scripts after services start up. [#93](https://github.com/lando/lando/issues/93)
*   Provided some more information for `lando info`. [#75](https://github.com/lando/lando/issues/75)
*   Added a `--deep` flag to `lando info`. [#75](https://github.com/lando/lando/issues/75)
*   Made `command` usage for `node` services more obvious. [#73](https://github.com/lando/lando/issues/73)
*   Added `varnish` service. [#62](https://github.com/lando/lando/issues/62)
*   Added `xdebug` options. [#65](https://github.com/lando/lando/issues/65)
*   Fixed bug where tooling cmds were dropping path parts in common with `appRoot`. [#104](https://github.com/lando/lando/issues/104)

## v3.0.0-alpha.4 - [June 9, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-alpha.4)

*   Added a `recipe` layer on top of `services`, `sharing` and `proxy`. [#9](https://github.com/lando/lando/issues/9)
*   Increased `maxListeners` for `lando.events`. [#9](https://github.com/lando/lando/issues/9)
*   Added `webroot` to `lando info` as applicable.. [#9](https://github.com/lando/lando/issues/9)
*   Added a `lamp` recipe. [#79](https://github.com/lando/lando/issues/79)
*   Added a `lemp` recipe. [#79](https://github.com/lando/lando/issues/79)
*   Added a `drupal6` recipe. [#79](https://github.com/lando/lando/issues/79)
*   Added a `drupal7` recipe. [#79](https://github.com/lando/lando/issues/79)
*   Added a `backdrop` recipe. [#79](https://github.com/lando/lando/issues/79)
*   Added a `wordpress` recipe. [#79](https://github.com/lando/lando/issues/79)
*   Added a `drupal8` recipe. [#79](https://github.com/lando/lando/issues/79)
*   Updated documentation to include information about recipes. [#79](https://github.com/lando/lando/issues/79)
*   Locked down host/container permission mappings. [#83](https://github.com/lando/lando/issues/83)
*   Added `wget` and `unzip` to `php` service. [#85](https://github.com/lando/lando/issues/85)
*   Fixed bug where `mod_rewrite` was not enabled for the `php` service by default. [#79](https://github.com/lando/lando/issues/79)
*   Fixed `linux` perm mapping when `LANDO_ENGINE_UID` already exists. [#85](https://github.com/lando/lando/issues/85)
*   Fixed bug where `win32` was incorrectly escaping command spaces. [#85](https://github.com/lando/lando/issues/85)

## v3.0.0-alpha.3 - [June 7, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-alpha.3)

*   Added API docs. [#48](https://github.com/lando/lando/issues/48)
*   Fixed bug where `node` was looking for webserver when in CLI mode. [#61](https://github.com/lando/lando/issues/61)
*   Refactored `sharing` to handle webroots better. [#61](https://github.com/lando/lando/issues/61)
*   Refactored `sharing` to prep for `osxfs` based sharing mode. [#61](https://github.com/lando/lando/issues/61)
*   Updated examples to reflect above. [#61](https://github.com/lando/lando/issues/61)
*   Added `memcached` service. [#17](https://github.com/lando/lando/issues/17)
*   Added `redis` service. [#14](https://github.com/lando/lando/issues/14)
*   Added `lando logs` command. [#56](https://github.com/lando/lando/issues/56)

## v3.0.0-alpha.2 - [June 2, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-alpha.2)

*   Added a [Backdrop CMS](https://backdropcms.org/) example. [#52](https://github.com/lando/lando/issues/52)
*   Added Lando API to documentation [#48](https://github.com/lando/lando/issues/48)
*   Added support for [php 7.1](http://php.net/). [#52](https://github.com/lando/lando/issues/52)
*   Added [composer](https://getcomposer.org/) to our php containers. [#52](https://github.com/lando/lando/issues/52)
*   Added `git` and `ssh` to our php containers. [#52](https://github.com/lando/lando/issues/52)
*   Refactored `lando.engine.run` to use `docker exec`. [#52](https://github.com/lando/lando/issues/52)
*   Added `extras` section for arbitrary post start build steps. [#52](https://github.com/lando/lando/issues/52)
*   Added `composer` section to install global deps for php. [#52](https://github.com/lando/lando/issues/52)
*   Added a tooling plugin to handle command routing. [#11](https://github.com/lando/lando/issues/11)
*   Added a `lando ssh` command. [#11](https://github.com/lando/lando/issues/11)
*   Added a `node` service. [#53](https://github.com/lando/lando/issues/53)
*   Fixed a bug where `extras` were not running serially. [#11](https://github.com/lando/lando/issues/11)
*   Added a `solr` service. [#15](https://github.com/lando/lando/issues/15)
*   Added a `drupal8-composer` example with `solr` support. [#15](https://github.com/lando/lando/issues/15)

## v3.0.0-alpha.1 - [May 24, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-alpha.1)

*   Initial release of Lando core framework.

## v3.0.0-alpha.0 - [May 23, 2017](https://github.com/lando/lando/releases/tag/v3.0.0-alpha.0)

*   Testing release cycle.
