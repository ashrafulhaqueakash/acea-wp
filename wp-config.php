<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '3rHRX~LYu.I$JAi!0;[SHcCWx*$4VMm9#}Y[gE Q#j@b25Dj5,|-E~V !qtoLAY0' );
define( 'SECURE_AUTH_KEY',   'P_?=M5L.+eWVv7y_o$}IY^f/mN0KgWco_i:*$  WP{;Nr@e.42W_8!*tMl6TWt]r' );
define( 'LOGGED_IN_KEY',     'Fh#zgYt3jbYcqxHp4X3wt{:RGMDK1R&Rt9FP,A^_v`g*1JH,U#)`9K_YB4xTMjH%' );
define( 'NONCE_KEY',         '_Ha4Jki5_Y)j*jp.=2*CGsnq|AJK&H?DAodK`5Y&S$_r25LzO68(32T-It@IbGO0' );
define( 'AUTH_SALT',         '@bPeJd2D,<xtxC`S`X1xtP5Nx+5G5[17c/&k&US-a<K/@Ui==;|B0}Ft*^NV]F,}' );
define( 'SECURE_AUTH_SALT',  'Njh^`mvi-TinZ*sa$/2F8-q+48b1-] %`V&]l#lrOI?slhdm/ {4(E|%$d6g_Pof' );
define( 'LOGGED_IN_SALT',    'U(nY*~{5s*mLh8J7hAW+/L_tOU9fXdeJ))5p{z|X1Rkx)_E<w)7e)1`wE%%k>]*x' );
define( 'NONCE_SALT',        '~dhBX+YK)rt}[i(K!88YK;,hqvLgM5`is@[)K8IK2+Ql;>h%#nBnt ZF AiBfYRI' );
define( 'WP_CACHE_KEY_SALT', 'KbQ?Q{(p0oa91Two~-1z3M][-$&?J1IB5/j=9]]gV=p~8e(_c-1}WBjf.F(PsvZ1' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
