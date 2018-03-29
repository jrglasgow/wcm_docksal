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
    1. if file is *.sql.gz - truncate the 'default' database
    1. imports the database file into 'default' database
    1. sanitizes the user emails - no truncation as it is not in a *.sql.gz file
    1. Repeats for all databases in alphabetical order,


Drush
  To run Drush in the project either use 'fin drush' or add the following bash alias
  alias drush='fin drush -i /var/www/.docksal/drush_commands'
  which allows you to also add additional drush commands or extensions to .docksal/drush_commands

To restart servers type <code>fin reset</code>. To start again with fresh servers and fresh DB import run <code>fin init</code> again.
