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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_php' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'CN+:a4e`mY#W[8f* 84x1D9xx7joKOcqpnDaveV8~QM-|0-.u?vQc?G|7q(%_vC~' );
define( 'SECURE_AUTH_KEY',  'b8!J0;-f0m}Y.CcY&L+q!52nsECKbVN`gSf7D=%>S@b7xg=iB:!0R7fK(PZUT6)b' );
define( 'LOGGED_IN_KEY',    'bz~r>Jp^;~ Yq^rzWqwaK:wqB]CGJhqoXdFni,Z?wPLo[lx&C 5B7H]KtmoKl@ZG' );
define( 'NONCE_KEY',        '5itI#hN8Hny;[,.8J/b%t6&X/B:3RU.f9>X3gy/`5uL#%U8B+/{gYnLXF4KI*u+/' );
define( 'AUTH_SALT',        '6/SM55J{)xMLWYmQ=(%R]kZ_T}Hj]8T=BA7KgQx&2{l!+H;wX_7,PetsUF-C/u}(' );
define( 'SECURE_AUTH_SALT', '2)Y9kQ---,.#_O!9Wku9G^DzKg3s4y@on(*e?E~&J Hu|FU6-(vcrCNk7*hC_9rP' );
define( 'LOGGED_IN_SALT',   'Y,3@%fv)(3O]93EYOyWN}EBnnsH{YBq|gbFNRPp6DzJGcE;fS@r7i>^v5<5 |A~t' );
define( 'NONCE_SALT',       'MSp%H(cQC+V/NP/0^{~zsZp5zOCT`@#ts:mBP/NWE@z8peIAZX;0cs><d6T;<_h;' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
