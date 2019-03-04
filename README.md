# Drupal solutions

- drupal site:mode dev
- drush cr //clear all cache
- drush pm:uninstall <module>

**Show Errors**
- add strings to settings.php:
  - error_reporting(E_ALL);
  - ini_set('display_errors', TRUE);
  - ini_set('display_startup_errors', TRUE);

**Export / Import Settings**
- drush config-export --destination <folder>
- drush config-import --source <folder>

**Export / Import database**
- drush sql-dump > ~/my-sql-dump-file-name.sql //export
- drush sql-cli < ~/my-sql-dump-file-name.sql //import


**Drush**
- cd /usr/local
- sudo git clone https://github.com/drush-ops/drush
- cd drush
- sudo composer update
- php drush --version
- sudo rm -f /usr/local/bin/drush
- sudo ln -s /usr/local/drush/drush /usr/local/bin/drush
- drush --version
- https://github.com/drush-ops/drush

**Devel**
- composer require drupal/devel, then go to Extend and install:
- Devel
- Devel generate
- Devel kint
- Web Profiler

**Webform**
- composer require drupal/webform

**Custom theme**
- **create** skeleton folders and files, required for custom theme
- sites/all/themes/mytheme/mytheme.info.yml (name, description, regions)
- sites/all/themes/mytheme/mytheme.libraries.yml (connect css, js)
  - sites/all/themes/mytheme/assets/css
  - sites/all/themes/mytheme/assets/js
- sites/all/themes/mytheme/mytheme.theme (Implements hooks)
- sites/all/themes/mytheme/config/install/mytheme.settings.yml (schemas: [])
- sites/all/themes/mytheme/config/schema/mytheme.schema.yml (two settings)
**templates**
(copy from core/modules/system/templates)
- sites/all/themes/mytheme/templates/html.html.twig
- and any templates, what you need
**Then install your's theme and set is as default**

**Basic settings for great work**
- in /sites/default/settings.php uncomment the lines at the bottom of 'sites/example.com/settings.php'
- in /sites/default/settings.local.php uncomment next strings:
  - $settings['cache']['bins']['render'] = 'cache.backend.null';
  - $settings['cache']['bins']['page'] = 'cache.backend.null';
  - $settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';
- in /sites/default/services.yml set in section twig.config:
  - debug: true
  - auto_reload: true
  - cache: null
- in render.config section:
  - http.response.debug_cacheability_headers: true


CONTENTS OF THIS FILE
---------------------

 * About Drupal
 * Configuration and features
 * Installation profiles
 * Appearance
 * Developing for Drupal
 * More information

ABOUT DRUPAL
------------

Drupal is an open source content management platform supporting a variety of
websites ranging from personal weblogs to large community-driven websites. For
more information, see the Drupal website at https://www.drupal.org, and join
the Drupal community at https://www.drupal.org/community.

Legal information about Drupal:
 * Know your rights when using Drupal:
   See LICENSE.txt in the "core" directory.
 * Learn about the Drupal trademark and logo policy:
   https://www.drupal.com/trademark

CONFIGURATION AND FEATURES
--------------------------

Drupal core (what you get when you download and extract a drupal-x.y.tar.gz or
drupal-x.y.zip file from https://www.drupal.org/project/drupal) has what you
need to get started with your website. It includes several modules (extensions
that add functionality) for common website features, such as managing content,
user accounts, image uploading, and search. Core comes with many options that
allow site-specific configuration. In addition to the core modules, there are
thousands of contributed modules (for functionality not included with Drupal
core) available for download.

More about configuration:
 * Install, update, and maintain Drupal:
   See INSTALL.txt and UPDATE.txt in the "core" directory.
 * Learn about how to use Drupal to create your site:
   https://www.drupal.org/documentation
 * Follow best practices:
   https://www.drupal.org/best-practices
 * Download contributed modules to /modules to extend Drupal's functionality:
   https://www.drupal.org/project/modules
 * See also: "Developing for Drupal" for writing your own modules, below.


INSTALLATION PROFILES
---------------------

Installation profiles define additional steps (such as enabling modules,
defining content types, etc.) that run after the base installation provided
by core when Drupal is first installed. There are two basic installation
profiles provided with Drupal core.

Installation profiles from the Drupal community modify the installation process
to provide a website for a specific use case, such as a CMS for media
publishers, a web-based project tracking tool, or a full-fledged CRM for
non-profit organizations raising money and accepting donations. They can be
distributed as bare installation profiles or as "distributions". Distributions
include Drupal core, the installation profile, and all other required
extensions, such as contributed and custom modules, themes, and third-party
libraries. Bare installation profiles require you to download Drupal Core and
the required extensions separately; place the downloaded profile in the
/profiles directory before you start the installation process.

More about installation profiles and distributions:
 * Read about the difference between installation profiles and distributions:
   https://www.drupal.org/node/1089736
 * Download contributed installation profiles and distributions:
   https://www.drupal.org/project/distributions
 * Develop your own installation profile or distribution:
   https://www.drupal.org/docs/8/creating-distributions


APPEARANCE
----------

In Drupal, the appearance of your site is set by the theme (themes are
extensions that set fonts, colors, and layout). Drupal core comes with several
themes. More themes are available for download, and you can also create your own
custom theme.

More about themes:
 * Download contributed themes to /themes to modify Drupal's appearance:
   https://www.drupal.org/project/themes
 * Develop your own theme:
   https://www.drupal.org/docs/8/theming

DEVELOPING FOR DRUPAL
---------------------

Drupal contains an extensive API that allows you to add to and modify the
functionality of your site. The API consists of "hooks", which allow modules to
react to system events and customize Drupal's behavior, and functions that
standardize common operations such as database queries and form generation. The
flexible hook architecture means that you should never need to directly modify
the files that come with Drupal core to achieve the functionality you want;
instead, functionality modifications take the form of modules.

When you need new functionality for your Drupal site, search for existing
contributed modules. If you find a module that matches except for a bug or an
additional needed feature, change the module and contribute your improvements
back to the project in the form of a "patch". Create new custom modules only
when nothing existing comes close to what you need.

More about developing:
 * Search for existing contributed modules:
   https://www.drupal.org/project/modules
 * Contribute a patch:
   https://www.drupal.org/patch/submit
 * Develop your own module:
   https://www.drupal.org/developing/modules
 * Follow programming best practices:
   https://www.drupal.org/developing/best-practices
 * Refer to the API documentation:
   https://api.drupal.org/api/drupal/8
 * Learn from documented Drupal API examples:
   https://www.drupal.org/project/examples

MORE INFORMATION
----------------

 * See the Drupal.org online documentation:
   https://www.drupal.org/documentation

 * For a list of security announcements, see the "Security advisories" page at
   https://www.drupal.org/security (available as an RSS feed). This page also
   describes how to subscribe to these announcements via email.

 * For information about the Drupal security process, or to find out how to
   report a potential security issue to the Drupal security team, see the
   "Security team" page at https://www.drupal.org/security-team

 * For information about the wide range of available support options, visit
   https://www.drupal.org and click on Community and Support in the top or
   bottom navigation.
