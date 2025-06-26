<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ecoledugameplay' );

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
define( 'AUTH_KEY',         '<7qg]uw[-^2G%8-&,gYZCPwE|%z{t Jp NzRZyw5ovuOFtR<.|5pTN6HKcXHl4Ph' );
define( 'SECURE_AUTH_KEY',  'N9c<5E-)__ck;gNp1xDaiW}x9qy7F1c9R/mF/J-P]SzP#EtKH63-yW$niG$$-{PN' );
define( 'LOGGED_IN_KEY',    'b:ye`OMSDc>VZ3^9<|[}5UVb*FqP83.~P+]O8ha-Q-O0)tZ2e8L57@y(Ac V_mS:' );
define( 'NONCE_KEY',        '7,^mTu>w?G?2>&/z={dqV=7O ^g2esH;U5nmPCR ;I5W5XG^,HiIoG|?AodA**.,' );
define( 'AUTH_SALT',        'hA6#zDs5p+@ne_5VE{*1@0a |1-4tFNFX@_ul- !kCC}CY!5@!H$-$U>opaC:+d*' );
define( 'SECURE_AUTH_SALT', 'Rb{?HsO_wm[)/s$_ciu~!!U94KlIF`D:A~,9o.QCq[n=mP;yQ{&%Bv4Z1;.[$?5S' );
define( 'LOGGED_IN_SALT',   'VK.soc_T;L]hX,uO]2c&Q2^,|,pgb&jQQ>7BZ`>5U_$#..:Ke&bBy@nIqM!5{M@u' );
define( 'NONCE_SALT',       'n+0~s7:(8_|p>oj:6FQN81FHFcZB0I,2Bpn#OMh+e0{bS90#N5pE=]p]ipW1kXD(' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
