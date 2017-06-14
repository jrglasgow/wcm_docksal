#!/bin/bash
apt-get update
apt-get install telnet
sleep 30;
/usr/local/sbin/nutcracker -c /var/www/.docksal/etc/nutcracker/nutcracker.yml
# I like to ensure that telnet is installed for testing

