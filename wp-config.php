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
define( 'DB_NAME', 'newwp_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',         't3~-)K9P}~skb?UX1k8<hK 1.tI9L~f,XgcDfeUm7>2e%nh&P40bu/&GmkQRU00$' );
define( 'SECURE_AUTH_KEY',  ' `!Q[!m]o#%R$]E.;o7,Ozl=`@6e#e9:/Ql~mL)$@q&Ad->jbEd{P;P pgG/xp:a' );
define( 'LOGGED_IN_KEY',    '2NDH)YdG|$l@WSTx?TF__a&[K$cy;$JjA$dTYXf{A4wUA!3CoqG#kv2R2B^M-wf:' );
define( 'NONCE_KEY',        '5XQjD|of/1=rw5SDv%a(*R[E8Jad ]YfLOpOX;*arg${1_zcHK4e>jJK%,md<?=3' );
define( 'AUTH_SALT',        'i+MJO3iuXIgsUfOXuUrg1}~/z%]w-baP&$$mzKMU+G|4C6Z!xSK;[,40F=1+Mk?T' );
define( 'SECURE_AUTH_SALT', 'g/>.&@$Niv7yFrsvQZ?J]/DR4=OcX5FTXa-w, ,,d]Pxq_gj&6c`ww@-RfeA71^-' );
define( 'LOGGED_IN_SALT',   ':>OsPlwW0_X(savD<W|_oIB^rUioEiUDuJsG1^2,HEtM(peYAlkvDp/_MtGB8{0V' );
define( 'NONCE_SALT',       'uzgmkk$m1+G_GjW!.jfI0XhXNat|4fk>7;F5X7^9:LGYFZ|cO.%<Q*OkM |LLgHh' );

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
