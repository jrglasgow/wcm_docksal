Docksal config directory for Drupal for the Web Content Management as a Service platform.

The goal is to keep this up to date with the current state of the platform, app servers, version etc... so tenants can keep their lcoal development environments up to date.

Installation:
1. install [Docksal](http://docksal.io/)
1. copy this repository to your project root as a sibling directory to your docroot/
1. copy or symlink your database backup (*.sql or *.sql.gz) into db/ this will get loaded on initialization
1. from the terminal type <code>fin init</code>

The init script will do the following
1. start docker servers
  1. web - apache 2.2
  1. cli - Command line interface for drush to interact with
  1. db - MySQL 5.5
  1. memcached
  1. memcached
  1. memcached
  1. memcached
  1. mcrouter - for testing
  1. nutcracker/twemproxy - for testing
1. import the database 
  1. truncates the database named default
  1. loads the database file in 
  1. sanitizes the user emails
  1. repeats for all db backup files in the directory in alphabetical order, so the first one loaded will be truncated, try to only put one file in the db directory at a time
