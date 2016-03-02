<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'HCR_wordpress');

/** MySQL database username */
define('DB_USER', 'groupx');

/** MySQL database password */
define('DB_PASSWORD', 'austin67');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '#a1EgAroDy--tHD]vJVp8&]xl `A)IW^@+qvycmoJR+-tT .J*4lz{loAi+pXSNP');
define('SECURE_AUTH_KEY',  'L[bn8%3Y!{$XRa~V:+[i{tBMIQw./ss:AF1/fGresMu1|Rq>kVaEyu5L5.xF}, h');
define('LOGGED_IN_KEY',    'D-X~$;zU-23Y3xU-hh,4mp+IB]#?N7*[]9$Y+#o}I]gw>}%#F9:t+?-i&H!YuhZF');
define('NONCE_KEY',        ';I-/C1@M/K`VV.A4{QL`F>auX7Zjl8MBm+Q|&$RgAfN|aihk0w7MB;#)lK3;Ubv#');
define('AUTH_SALT',        '|kv|BF.=0i}w%USvx~{%by9@a!?J~f:dfs-W J:?06LSJFd4XmN@P1C&`(*cWlfe');
define('SECURE_AUTH_SALT', '%CWs:k*I(uWFVE_(MBrX/[5-lY]si(.,UV3jrs:K Jx|yuGWJuUVYx|lspLpd-L|');
define('LOGGED_IN_SALT',   '&Y6J5rsKbEe=>a+e4..0N0.-DAe3q.8lmXbWCQ+oZ{CzK?k{y<4`N#e}xqW,fZ5B');
define('NONCE_SALT',       '[-L>;k+sq&[![D|^+|r;T]|>Ii,: M Vjp!?IyvM-,f-WsQ5]Wa|tEl3mGX@Bl__');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
