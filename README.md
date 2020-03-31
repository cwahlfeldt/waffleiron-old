# waffleiron

[![CircleCI](https://circleci.com/gh/cwahlfeldt/waffleiron.svg?style=shield)](https://circleci.com/gh/cwahlfeldt/waffleiron)
[![Dashboard waffleiron](https://img.shields.io/badge/dashboard-waffleiron-yellow.svg)](https://dashboard.pantheon.io/sites/937260c2-446f-4aa2-8a7b-fd76046e32fa#dev/code)
[![Dev Site waffleiron](https://img.shields.io/badge/site-waffleiron-blue.svg)](http://dev-waffleiron.pantheonsite.io/)


waffleiron announcement


The new Thomas Mamer website is currently using a custom “framework" codenamed waffleiron. waffleiron is basically a wrapper for a Wordpress site on pantheon but with a ton of cool features to help automate every site that uses the framework. Old sites that we host on pantheon (and elsewhere) can be ported over as well (currently only Wordpress but def Drupal in the future).  

Im creating waffleiron as a way to allow myself to maintain and create websites much faster than how I or past developers have done things. I get that we are a small company and this will make our lives easier by speeding up development time and allowing updates and site maintenance to happen under one umbrella.  

With that said heres a list of features to better describe the framework and then ill dive into TM which uses the framework and rundown the custom post types and their fields.
  
    waffleiron :   
1. Fast setup. Be up and running in matter of minutes with a local pantheon environment that syncs to pantheon, using Lando ( https://github.com/lando/lando ) and other build systems.
2. Continuous integration testing with CircleCI ( https://circleci.com/continuous-integration ). I can explain this more ls later but, it means its setup to continuously test code and deploy it to pantheon when it passes the tests. This even includes browser testing. Also Jill pointed out good workflow that’s being introduced to pantheon soon that will make this better 👍  
3. Git workflow; All sites are treated as branches of a single upstream ( https://github.com/mckenziewagner/waffleiron ) that keeps all sites in sync with updates for Wordpress, plugins, and configuration. Pantheon allows custom git upstreams and an easy way to deploy them. Also everything important is kept as code where it should be 🤘  
4. Automated documentation that is created and hosted sing the WP interface 🙏 ☺️
5. Up to date theme (Belgium) with advanced custom fields and Gutenberg.  
5. Up to date theme (Belgium) with advanced custom fields and Gutenberg.  
6. Push Pull Overwrite. Do it all with the command line.  
7. waffleiron comes with command line tool called “iron” that can do all of these tasks and more with a few calls to the interface. This is mostly for developers but its good to know how its automated and how the command line lets you do anything ( see docs for a more complete list.  
  
    # INSTALL all dependencies (composer, npm, docker, lando...)  
    # also sets you up with a local lando/docker server  
    $ iron init      
    # START the local server  
    $ iron start  
  
    # PULL code, database, and files  
    $ iron pull     # pull from any environment on pantheon     # using the &lt;site-name&gt;.&lt;dev, test, or live&gt;  
    $ iron pull windsor-west.dev     $ iron pull thomas-mamer.live          # PUSH up to pantheon     $ iron push     # or to any environment  
    $ iron push windsor-west.dev     # or push to multiple environments with filters     # good for mass updating a bunch of sites     $ iron push --all "custom-upstream-name"      # ... more cool stuff ...  
    # create a new site under the mckenziewagner organzation and deploy to pantheon.     # this will also install all the default waffleiron plugins, files and database.     # Your site will be available at https://dev-waffleiron-new-waffleiron-site.pantheonsite.org     $ iron create-site 'New Waffleiron Site'          # create a new post type from the command line and set it up     $ iron create-post-type          # see all commands     $ iron help      # ... documentation is hosted on the site as well :)  
      
     waffleiron Fields :   
  
waffleiron website fields to type scheme  
Legend : CONSTANTS ALL POST PAGE CUSTOM ECOMMERCE   HEAD  
* Meta Tags  
* Meta Keywords * Meta Description  
* Meta ... * Site Title * Site Tagline * Configuration   
  Navigation  
  * Heading   * Intro   * Copy   * Banner (also allows for "call to action")   * Call Out   * Relationship ( relate any post-type )   * Social Media Center   * Contact   * Location *** Product  
 ** Ternary Nav   
    Footer     * Date & Copyright     * Contact     * Banner ?     * Social Media Center ?      * Location ?     * Secondary Nav ?  
  
  
…. Work in Progress…. mostly complete for sites currently in development, and deployed on pantheon.
