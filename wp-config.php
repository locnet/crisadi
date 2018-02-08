<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/home/romflyserver/estudiocrisadi.com/wp-content/plugins/wp-super-cache/' );
define('DB_NAME', 'estudiocrisadi_com_1');

/** MySQL database username */
define('DB_USER', 'estudiocrisadico');

/** MySQL database password */
define('DB_PASSWORD', '9tcPvFDb');

/** MySQL hostname */
define('DB_HOST', 'mysql.estudiocrisadi.com');

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
define('AUTH_KEY',         'sK/k+cD0jV%yCfbN0ygqjm2YrN@zoY+!hOK`u4w+wu*%~TKU7kG8GzW+Qw/Y4zD(');
define('SECURE_AUTH_KEY',  '3A5c1t9M/k*v/J#p9:E`7djETFt2BP!?+"kWGA@p`yCwG2UcLjuQn:mwk0|Ti;Gy');
define('LOGGED_IN_KEY',    'v:aBeB;Mm4wyS|Ub;~gSO3DUD|`ThvZ)d_!#U;MHT(d2Cak|NX!cl(^J7*S`zf4b');
define('NONCE_KEY',        'NE(so~#P$arVcKVwj(dDBjFQC%%lEOf5yEl2;LZE#0i;(t(vxp;m$JP2S?QD~nCU');
define('AUTH_SALT',        'JBfD:_+|NmOYejt@U7my1ksGr)%21wx/1ZBX9mLsAYK5H&m&3kBXpJ!)"o9Fb5IO');
define('SECURE_AUTH_SALT', 'h:`~sna(rIo$"k7"wjOuXfpquna;Al^"i5$?8VI2kMv~d2V9*R:wXm2*kgxMHsQu');
define('LOGGED_IN_SALT',   'ZPe;5h?^PxkgxZ06tS7kf8Kw3CG?ckndW9opmJXFXMUBYfQhvn("?100:%wr7cFp');
define('NONCE_SALT',       'G6DDanwol++3C?ZX(FA*ox2FvRKeq~~Wop+HVnbt4rC%te6DU;Df0+Txsia?mhrK');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_qtjfbj_';

/**
 * Limits total Post Revisions saved per Post/Page.
 * Change or comment this line out if you would like to increase or remove the limit.
 */
define('WP_POST_REVISIONS',  10);

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
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
