<?php

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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'autotimorleste');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'y_-,F_y@Pre*nh2=xVr7U?-%+Yw(2R {jb:j@6ko2L$m[ t?-]Pty.?7k+p)3Cj>');
define('SECURE_AUTH_KEY',  '0-ggn~=3?KEE?JIzhw;(e2J$+4(!K/ .Xa/L[cdCp?Ih0AL3Of8#-h@oXYA+W31;');
define('LOGGED_IN_KEY',    '[;%?W,gxWPxfYIglik!0Y%)>,k/*ksW yJ9f<WfF:sJ6b]A<R>=%UOZ#AEnMtFWl');
define('NONCE_KEY',        'GgXFMj_^88acK_+-a1V:_*JO(z`odUqTt^1|+S$Tcg[uD((R%YVv+%CZB5GPa:`h');
define('AUTH_SALT',        'hz|yHN/f=05cccX8Hf:!=-E%gKmo:?-{+iIr-m4MKm+@H=R})m2N[DFeVfKnFenN');
define('SECURE_AUTH_SALT', 'ApF.dlbfa((`3)%;$+Ok;aecD^+fwL+)LH}K+GfMD(|+g YWQ.OqAi&OBGYq2S< ');
define('LOGGED_IN_SALT',   '%9N4X]*|w/6Xsy4&d@Z=m9buT5E -U-4]7:_7ntQ6~vBYK1?F@iSj&n@*0lkw{A0');
define('NONCE_SALT',       'M^z`Q&6$oXihS[X@])&Aq.~qZY9#.?b4rN%?J|DonyTm?+NCO+a:Rp4+S#aZ7T< ');

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
