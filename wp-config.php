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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'lensestech_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost:3308' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'oNF?Kg59Y^<S9Gv-qwU%Psrm^t*~mvtJx:Bq?+0Z]iT=2QVX=Alm,1E-#PuK ^DO' );
define( 'SECURE_AUTH_KEY',  '.+0gcgnTG`f4ADZs+Gr|<NRlK;e]u)>%vC.7 R?.~;bI7&Iv8!oa=bAvq~Qv,UNb' );
define( 'LOGGED_IN_KEY',    'c`bq*BXxI?[0aHZJCbRDm]KXz3,y?>n?PRgs3d=q$vY^U$0PL6A ]B#(`vqf6VJ}' );
define( 'NONCE_KEY',        '[fp<BrL%`ExU(.6&r&=ZgbyKO,SvrOm)8^.WFdT[HqT)lr~oaATn.mprTPuvaKb&' );
define( 'AUTH_SALT',        'FbKxdZ[<IuiZglSDtf)|KJK5+p5DT_HWjr-#|#+%p$t0om4vm r6Oj[jI8{;pdME' );
define( 'SECURE_AUTH_SALT', 'F37lxU+_6bzA84-_~UNco?hld_Qu,!4$Xz$@X~ht0*Ab<.| R:o5ugL&J`7& wB.' );
define( 'LOGGED_IN_SALT',   'JiF`|^|Hn#&0X)*$&@7o4_C@NYLE_aUxz-/NpIZ9Bz0iQnd i0f0q.|SW$BP$B(P' );
define( 'NONCE_SALT',       'fI=#-3wW#G9v+B86eXgsQ3F[OS[gSh*)I2feyv,!6Ey1VI3kUx|Uj:1fWrKfrra$' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
