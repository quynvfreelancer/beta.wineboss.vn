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
define( 'DB_NAME', 'wp_wineboss' );

/** MySQL database username */
define( 'DB_USER', 'wp_wineboss' );

/** MySQL database password */
define( 'DB_PASSWORD', 'wp_wineboss' );

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
define('AUTH_KEY',         '2U4[zYZ1EsH7i8m}`3Ck§zk_0C%sZV>TH@VV@{F5Q§ZPk+f8@Oel+VtB7XkhJ&c$');
define('SECURE_AUTH_KEY',  'Px<~uCG8^|>8kBHawcR$+|wB]P+1:6@-w1z>|jA8T^9@1Y(BMK<+dX37[qZVSOBI');
define('LOGGED_IN_KEY',    'R)>l`~KY2S|?/8sFVu:D?)O?Uu:kjIAZja4@XF6O65v@jD`N1568_a%R$VW/cj.o');
define('NONCE_KEY',        'A8&i[`q64/Bll=)E%x{&b+XJU@(xli:t_Wt}UjsJlC`~2@&o@vbf`$khG`Yv|ljE');
define('AUTH_SALT',        '[qg,h^N,_mF:oG&i3[+ceu((sA!$q%Q7ukaHxe0B3?IijN[G`$l@Y@4&w_-ytU$X');
define('SECURE_AUTH_SALT', 'EXL§%6mP%1-N_q}$E(OU enf+H-tN]v.hR40O>g[H,W@?.TVPmlk%),31r(]Xu|_');
define('LOGGED_IN_SALT',   'vemAm7=)a+5,]Oiar)7%_:p[>n27@.^iq kiAV[~??oZQB^pmaP]73vCQJ!z=,`1');
define('NONCE_SALT',       ';9m|<!YWF?{m[pH§{040NnAWYo:_coT4+Jkwwgyue:EwL &+.3?D`D?[]s3BKGa/');

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
