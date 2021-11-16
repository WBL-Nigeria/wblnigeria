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
define( 'DB_NAME', 'wblsite' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'o@Ls73V OV>{Xm)jxBNYF!Ykqx/p}%WZ8s?Thbv?_v7QN$+!I59Al$UmAl!Pn8Cn' );
define( 'SECURE_AUTH_KEY',  'V;1zm)n8W1XyTJ.;(}O{E?O#HgJR~:t2fc^/48m8/SH;Ct!Rtt#GpAAPRol1`A/%' );
define( 'LOGGED_IN_KEY',    ':sC)OoHL1p}$BI}1/Zb(dB_^9J{`_WC`(s3k?jh)CvfAG->I, :v0Fjt WefkNy_' );
define( 'NONCE_KEY',        '+o+m;@#kgS}(cYt:b@co-`3b%(s~G1nZZnGtD]ym9/$A /T.C:!X&PM_D+lum*qa' );
define( 'AUTH_SALT',        '%HoX+!DeYj,(Ihd}sU24o~}Q]Ht59zH}F;QTBJmY}ifd}UDcfdpz=fXRG#{;!/0%' );
define( 'SECURE_AUTH_SALT', '5)P+8fdp}N;XA*%D(^|vM|@$_Mla|9]%|dOd|1^7%9zzUxr|8wy4#ABY]CML*n13' );
define( 'LOGGED_IN_SALT',   'JKa;+6W4S|Kbxia;T<fdT<<]E[/8UCO0;rLuW6YBycwFU0*7o$I:rAfFXU[3^>AE' );
define( 'NONCE_SALT',       'd}rW^{~UFnU&Pj){aR^[+^ ipgOF.AmmX9rPH.Oui(T;=IP9Ux&/j,q{MKKk7fv9' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wbl_';

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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
