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
define( 'DB_NAME', 'kuis-pekan2' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         '|l L@HYoKs1TTEnw~20G;x7{-qH5z+lqVEZ8n.V$.mpY8 dPKKJZhXKGIT@H#*^Q' );
define( 'SECURE_AUTH_KEY',  '-E7OOp{HcJ:=Fr4XbJb7KBBg$sfZpFcvhge`H4SPN!E#*]=^Ka?5uvgQKv5gt^SF' );
define( 'LOGGED_IN_KEY',    'Ho^YcJ,{NDE7ps65{:Vvz+Z}SP`zUK]r[BN9J,FumK7MUNI35?GlMik=g*6*SVp@' );
define( 'NONCE_KEY',        'QtMq6eI<_$/h)AqmyxD;_f<+#~z=6Z}U[6uCm.avPxQaq.x3p)S^w]_0ucTWaeJ]' );
define( 'AUTH_SALT',        '.0DhM_D}Zk.nWYW-rM($9h5l0WyEKOUd3)cUg<[8LB{&q@) vJH>;:Tmea+1>c~1' );
define( 'SECURE_AUTH_SALT', 'Lsf%lT]QRaO?.[fcO(SP2:flByP24== ;B+2L&?8aqMUivCQ>X^KpYIFbE)s^8iN' );
define( 'LOGGED_IN_SALT',   'G H>9^<X=>qR~mO#?VXbdO=`d${@{MF|)vUwUji:(rEO0>vL/Bne_xgITFMiw)*S' );
define( 'NONCE_SALT',       'u0E[<vul]5TYa5VtcQWwEd~DKz8{Z314!vJ6qoK1RaA&-hf3<_|8PBcr}-S%uRS(' );

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
