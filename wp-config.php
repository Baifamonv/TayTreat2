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
define('DB_NAME', 'taybase');

/** MySQL database username */
define('DB_USER', 'taytreat');

/** MySQL database password */
define('DB_PASSWORD', 'taytreat');

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
define('AUTH_KEY',         'A78MUd6[o=05f?/qXznffu/n#xu44O_T:ycFkNk2v&x:2/)07(D9(:}0i;m-=bhH');
define('SECURE_AUTH_KEY',  'Ky(q~LhW$NZD2Yld!50:V^I/yp}JjMY(2MOZcDw|(_#+twd8Lz4rY7j0Mv0DvoY9');
define('LOGGED_IN_KEY',    'VMciWKu5dijFILr#Ike*;oEv}5[]kVcBJ22b _hIyvczs<`n`jGI2rj|igD:J%ZN');
define('NONCE_KEY',        '%00pfX{~95ReqoVyJ`hF&nesV*Jb,=B3:6.NdJYi7_>[8|V{Sh1:t}8r_z?[%2$8');
define('AUTH_SALT',        'uB_RL>X_NnW,yER~,Lz1*AhRe=d1^1cWOp#C~bA%L,PRvdU=r35n?F%iDndm9w*E');
define('SECURE_AUTH_SALT', '=N+mZN9@l>1hzxEN}9Rso]D%I4@J_x~Q2!%i]X{Os~cy>&pYrr<{0}0c3QP{me9^');
define('LOGGED_IN_SALT',   'S}9B,E*K9{t@ufNwm?!jD+y`,aKF[)A8E#l.eX|SyfB@6P/%6ygpQn*Q6O1t<lj(');
define('NONCE_SALT',       'qde(Ioa.4;sRmB,w1W=HOcxG6,`DSWFmF7oBq?#DX-*EKB2OuJP :bx5 0NHi{7/');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
