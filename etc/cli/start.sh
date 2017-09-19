#!/bin/bash
sudo apt-get update
sudo apt-get install libsodium-dev -y
sudo apt-get -y --force-yes --no-install-recommends install php-pear libssl-dev php5-dev
sudo pecl install libsodium-1.0.6

/opt/startup.sh supervisord
