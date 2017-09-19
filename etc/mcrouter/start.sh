#!/bin/bash
sleep 30;
/usr/local/bin/mcrouter --config file:/var/www/.docksal/etc/mcrouter/mcrouter.json -p 5500 --enable-flush-cmd
# I like to ensure that telnet is installed for testing
apt-get update
apt-get install telnet
