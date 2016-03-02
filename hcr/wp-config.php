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
define('DB_USER', 'admin');

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
define('AUTH_KEY',         'zWqQ+F_5(#vu1k`PR.c0d-Y11h,JjOzR`EGO/Vncxn{ky)`o#G^0bwE6cgxd/pT7');
define('SECURE_AUTH_KEY',  '34xVFWIM6=)u,kTx= a,=qN,?E-vuA_d-FbA@uQ/,%{kg@V$,IE)l=D{G 7HVI($');
define('LOGGED_IN_KEY',    '*K2Pn(~|1UX[f@6JpG#RpSl2&+?u4-IJb^-Pjul^0y7-MJ`grS977-:H[y{9uC+g');
define('NONCE_KEY',        'k,4v=:A.2tj!z5NC-nuixOq413!*vl6H<;]sfh5x26rTWcTw,7T<eVrLnJ}iJ:Kv');
define('AUTH_SALT',        '~T0TT+I}c|9-r~SS-Aoc=|Zg0|5ehb|S8<X^<]!RUuU^]niB St|07*W$qNiFPB}');
define('SECURE_AUTH_SALT', '?+:hS+)2hxT_`G7`t>Rq<`yAxg]V^fK2z}Tb,nFjb=YxfLws%ew#YKEZ+)YHLjlD');
define('LOGGED_IN_SALT',   'd&C+lZZhj;PE~pOjvD|!:D/hTe+juoy->%{(&(=U{r(|$MP:Ivna-d;+wY~+Z+#o');
define('NONCE_SALT',       '{e_|2827@L2|~A38^ QU13W*]k%GOyJVi%,w/Z!K>=-PiX*6{]i5cU.+q(b&Z>A>');

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
