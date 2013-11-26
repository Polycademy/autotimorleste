<?php

define('ENVIRONMENT', isset($_SERVER['WP_ENV']) ? $_SERVER['WP_ENV'] : 'development');

/**
 * Automatic Url + Content Dir/Url Detection for Wordpress
 */
$document_root = rtrim(str_replace(array('/', '\\'), '/', $_SERVER['DOCUMENT_ROOT']), '/');

$root_dir = str_replace(array('/', '\\'), '/', __DIR__);
$wp_dir = str_replace(array('/', '\\'), '/', __DIR__ . '/wp');
$wp_content_dir = str_replace(array('/', '\\'), '/', __DIR__ . '/wp-content');

$root_url = substr_replace($root_dir, '', stripos($root_dir, $document_root), strlen($document_root));
$wp_url = substr_replace($wp_dir, '', stripos($wp_dir, $document_root), strlen($document_root));
$wp_content_url = substr_replace($wp_content_dir, '', stripos($wp_content_dir, $document_root), strlen($document_root));

$scheme = (isset($_SERVER['HTTPS']) AND $_SERVER['HTTPS'] != 'off' AND !$_SERVER['HTTPS']) ? 'https://' : 'http://';
$host = rtrim($_SERVER['SERVER_NAME'], '/');
$port = (isset($_SERVER['SERVER_PORT']) AND $_SERVER['SERVER_PORT'] != '80' AND $_SERVER['SERVER_PORT'] != '443') ? ':' . $_SERVER['SERVER_PORT'] : '';

$root_url = $scheme . $host . $port . $root_url;
$wp_url = $scheme . $host . $port . $wp_url;
$wp_content_url = $scheme . $host . $port . $wp_content_url;

define('WP_HOME', $root_url); //url to index.php
define('WP_SITEURL', $wp_url); //url to wordpress installation
define('WP_CONTENT_DIR', $wp_content_dir); //wp-content dir
define('WP_CONTENT_URL', $wp_content_url); //wp-content url

/**
 * Secrets
 */
require_once('Secrets.php');
Secrets::load();

/**
 * MySQL settings
 */
if(ENVIRONMENT == 'production'){

	define('DB_NAME', $_ENV['secrets']['database_name']);
	define('DB_USER', $_ENV['secrets']['database_user']);
	define('DB_PASSWORD', $_ENV['secrets']['database_pass']);
	define('DB_HOST', $_ENV['secrets']['database_host']);
	define('DB_CHARSET', 'utf8');
	define('DB_COLLATE', '');

}else{

	define('DB_NAME', 'autotimorleste');
	define('DB_USER', 'root');
	define('DB_PASSWORD', '');
	define('DB_HOST', 'localhost');
	define('DB_CHARSET', 'utf8');
	define('DB_COLLATE', '');

}

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         $_ENV['secrets']['auth_key']);
define('SECURE_AUTH_KEY',  $_ENV['secrets']['secure_auth_key']);
define('LOGGED_IN_KEY',    $_ENV['secrets']['logged_in_key']);
define('NONCE_KEY',        $_ENV['secrets']['nonce_key']);
define('AUTH_SALT',        $_ENV['secrets']['auth_salt']);
define('SECURE_AUTH_SALT', $_ENV['secrets']['secure_auth_salt']);
define('LOGGED_IN_SALT',   $_ENV['secrets']['logged_in_salt']);
define('NONCE_SALT',       $_ENV['secrets']['nonce_salt']);

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', __DIR__ . '/wp/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
