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
define('DB_NAME', 'crisadi');

/** MySQL database username */
define('DB_USER', 'adrian');

/** MySQL database password */
define('DB_PASSWORD', 'r0m4ni4');

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
define('AUTH_KEY',         'Q@Q9u$;6lVJ lG?p[,($q(-4>! `fCprm71Nzv*.D^eTjb.Y)T9!ePQO`!pe8T4c');
define('SECURE_AUTH_KEY',  'dBS(97KNBHCL^>Q0<ZUBd<5Wmcp]#aQm}/ CRdy`^**e_QxL@CV{h>|pcgY85p)/');
define('LOGGED_IN_KEY',    ':E iun+i~zH;_(TFn_W<8_H-avr+qXA*srH3G/bA$d$C{ @#]xqS=yE,j!KV^FA8');
define('NONCE_KEY',        'V-&J5EE@IPm&59YCxCNOgwe!ZAr!#vsh*m?8ER8YBJ.I;l;|qFO)Hw=+8]8i#kC1');
define('AUTH_SALT',        'C=v?VwY++)L5zuF:x=zVH,5<YkPk=/ooBKw*]bvanf<.t<F~c6R,`[__&3JqdmDI');
define('SECURE_AUTH_SALT', 'EI_5cHZKjqVSXEa0~n5^@9eyeLSLPj*Y`;NJ848<1I{A?,h2nUsqFoI,G?%=#SIq');
define('LOGGED_IN_SALT',   'N3VEkUOSK(1`M4Yz?q-4M%X$`Y)lBnRiIj+=/wV;lt)Ae-+ dnQa<D}_iGYdJ5<E');
define('NONCE_SALT',       'xV!,)Hh^0ESBzK} ;Z@omYLj?Q Gn{3CbUyUbXY{tBC$B&kz0YT~B1)O!ghuWj0J');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_qtjfbj_';

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
// trebuie stearsa linia asta in productie
define('FS_METHOD', 'direct');

