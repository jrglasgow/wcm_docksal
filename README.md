Docksal config directory for Drupal for the Web Content Management as a Service platform (WCMaaS).

The goal is to keep this up to date with the current state of the platform, app servers, version etc... so tenants can keep their local development environments up to date.

Installation:
1. install [Docksal](http://docksal.io/)
1. copy this repository to your project root as a sibling directory to your docroot/
1. copy or symlink your database backup (*.sql or *.sql.gz) into db/ this will get loaded on initialization
1. from the terminal type <code>fin init</code>

The init script will do the following
1. start docker servers
    - web - apache 2.2
    - cli - Command line interface for drush to interact with
    - db - MySQL 5.5
    - memcached
    - memcached
    - memcached
    - memcached
    - mcrouter - for testing
    - nutcracker/twemproxy - for testing
1. import the database 
    1. truncates the database named default
    1. loads the database file in .docksal/db
    1. sanitizes the user emails
    1. repeats for all db backup files in the directory in alphabetical order, so the first one loaded will be truncated, try to only put one file in the db directory at a time


To restart servers type <code>fin stop; fin start</code> To reset all servers type <code>fin reset</code>.


## Initialization script:
To start with an existing code base or to start again with fresh servers and fresh DB import run <code>fin init</code> again. This will reset and re-import your database and re-run your develop script to enable development modules.

The <code>init</code> script does the following:

1. fixes permissions
    sets permissions of docroot to 755
1. Initializes settings
  1. Copies settings.local.php to docroot/sites/default with default local settings to override the configuration in settings.php file in the code base if it doesn't exist. The default file is already configured with connection strings for database and memcache.
  1. Copies sample drushrc.php file to docroot/sites/default if it doesn't exist.
  1. Ensures the Docksal virtualhost gets loaded in docroot/sites/default/drushrc.php
  1. ensures docroot/sites/default/settings.php exists, else it copies docroot/sites/default/example.settings.php.
  1. Adds a conditional include of settings.local.php in the docroot/sites/default/settings.php file if it doesn't exist.
1. Resets all servers - or initializes all servers if not currently running
1. imports all databases in .docksal/db
  * imports all db dumps in alphabetical order
  * if file is *.sql.gz truncates the database first
  * if file is *.sql database is not truncated first, this is suggested for database sanitization queries.
1. Checks for existence of .docksal/commands/develop script and runsa if exists, default develop script is included by default
  1. clears the module list
  1. rebuilds registry
  1. disabled syslog and autologout modules
  1. downloads/enables development modules
    * devel
    * search_krumo
    * dblog
    * views_ui
    * context_ui
    * stage_file_proxy
    * diff
    * mail_redirect
    * update
    * xhprof
    * missing_module
  1. runs all database updates
  1. downloads/runs utf8mb4_convert drush script
  1. checks for .docksal/commands/develop.local.sh and runs if exists
1. if you are running Windows you are told the line you need to add to your hosts file to access the VM
1. url for accessing the VM is displayed
1. ip/port of mysql server is displayed
1. login link is generated for either UID 1 or the account defined in .docksal/docksal-local.env