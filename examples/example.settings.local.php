<?php
/**
 * local settings for the Drupal development instance
 */

# Docksal Drupal connection settings.
$databases['default']['default'] = array (
  'database' => 'default',
  'username' => 'user',
  'password' => 'user',
  'host' => 'db',
  'driver' => 'mysql',
  'charset' => 'utf8mb4',
  'collation' => 'utf8mb4_general_ci',
);

# File system settings.
$conf['file_temporary_path'] = '/tmp';
$conf['file_private_path'] = '/var/www/.docksal/private';
# Workaround for permission issues with NFS shares
$conf['file_chmod_directory'] = 0777;
$conf['file_chmod_file'] = 0666;

# Reverse proxy configuration (Docksal vhost-proxy)
if (PHP_SAPI !== 'cli') {
    $conf['reverse_proxy'] = TRUE;
    $conf['reverse_proxy_addresses'] = array($_SERVER['REMOTE_ADDR']);
    // HTTPS behind reverse-proxy
    if (
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' &&
        !empty($conf['reverse_proxy']) && in_array($_SERVER['REMOTE_ADDR'], $conf['reverse_proxy_addresses'])
    ) {
        $_SERVER['HTTPS'] = 'on';
        // This is hardcoded because there is no header specifying the original port.
        $_SERVER['SERVER_PORT'] = 443;
    }
}



#---- memcache settings/
$conf['cache_class_cache_form'] = 'DrupalDatabaseCache';
$conf['cache_default_class'] = 'MemCacheDrupal';

$conf['memcache_key_prefix'] = 'docksal';
$conf['memcache_servers'] = array(
    //'memcached1:11211' => 'default',
    //'memcached2:11211' => 'default',
    //'memcached3:11211' => 'default',
    //'memcached4:11211' => 'default',
    'mcrouter:5500' => 'default',
    //'nutcracker:22121' => 'default'
);
$conf['memcache_bins'] = array(
    'cache' => 'default',
);

$conf['cache_backends'] = array();
$conf['cache_backends'][] = 'profiles/dhs_wcm/modules/contrib/memcache/memcache.inc';
$conf['lock_inc'] = 'profiles/dhs_wcm/modules/contrib/memcache/memcache-lock.inc';
$conf['memcache_stampede_protection'] = TRUE;

# uncomment and fill in your production server address
$conf['stage_file_proxy_origin'] = "https://www.example.com/drupal";
