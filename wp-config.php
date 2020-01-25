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
define( 'DB_NAME', 'syfte-wp' );

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
define( 'AUTH_KEY',         'wWx7SQH~sFmA{c5c4.:wB6|vu@w9VmVASA|?2O<w<jjWm0/8V~H|(kf+,a%/J]Xo' );
define( 'SECURE_AUTH_KEY',  'z,gmChc*1rNFWFIovu A &i!Q-#sMv)BReBeB-L1Z-0,,SOknE}:!e>Wp~=Ll!cw' );
define( 'LOGGED_IN_KEY',    '((Z1VJ3#myI6s:c,(P<#L83cUA$iO:v0<eGIQGne&l5!3 1yKIs^B6y<~{7A^3ca' );
define( 'NONCE_KEY',        'w4RT 1I_R +/`2dHPznqC6R/^5ov^;P]z/At<`0Bnuw<Z:rur EG68N_p]CReg)$' );
define( 'AUTH_SALT',        ',}}nF:^4S:C#l(+v9?{A`KnECw3Q/+2#SWkJE5[uU5N,0mW4pCZrJ1W*bHF?uWe.' );
define( 'SECURE_AUTH_SALT', 'PzMZ+G3/>dJ#]M*M_:O`joO~zGX9Yfr:qiCy_h&xMScn5tR,cchTNu/SS|`&yHn8' );
define( 'LOGGED_IN_SALT',   'Ga=#r-hHxr9n0TS8}SWsp!rA5BRii{&,0Tw]OL@,CwIT|QS{]cAX.,bI-3jtQ3On' );
define( 'NONCE_SALT',       'A;WTAUKcIQyNe{_2PuQ`Sk-+;$]/Yki4$Rn0j6OZ=5$iPj):=r>cYeXG!oSIq*Qw' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
