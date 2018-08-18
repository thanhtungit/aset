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
define('DB_NAME', 'eset');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '8pp0>T/[;em,o|dip{Y@B2e;I*h0RMPf^{z0VOpVgvq-;w 1=XqeZ98S*t4xA/(@');
define('SECURE_AUTH_KEY',  '1p~q5FCBa_3}L7r[Zm,#u|S`N%hK`,*NXSm5[o~7[X?7!?UXq`h77TynpF L^*Rj');
define('LOGGED_IN_KEY',    'caKDqzB@tRbo1H7MulmQH:UE`$CjR0S13iyznbuE.z.NL5&o5J#0=>Cdk.BOT:gC');
define('NONCE_KEY',        '|2*gmdG(XjS+MGsbzZK_Mt}E?j6_{Gd9[NWiQIfzs`%{~4txE}vW`j6qbLzYMl)1');
define('AUTH_SALT',        ')/Q*p7uVtQD0PW@8q$LP@1{9wAX-}Nd(>LuIn sc1e)}P,Q!xjF]7NN|rDYr[5Km');
define('SECURE_AUTH_SALT', '<4mud4<,:o@bAJZ^G3%JlE/CUhYZ<%7m:qhi*,~!rFDCD%jL2|n;VY/vJ~Fd6mvz');
define('LOGGED_IN_SALT',   '|XSHKvNSSphe^Q#(?~= ZJ7(De*uoequ^%EK>m9jR!m`An.lH&?!2UCJd[.;:Lgd');
define('NONCE_SALT',       'ukTEimp~ZonFO@e_u#WN<L<m~)!b4}Y~^I4<Co6:!DS,a z`4tnIJ{:N=p-IQa&[');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'aset_';

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
