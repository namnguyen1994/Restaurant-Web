<?php
/**
 * Backward-compatibility functions for when theme requirements are not met
 *
 * This file must be parseable by PHP 5.2.
 *
 * @package geritcht
 */

/**
 * Gets the message to warn the user about the theme requirements not being met.
 *
 * @global string $wp_version WordPress version.
 *
 * @return string Message to show to the user.
 */
function geritcht_get_insufficient_requirements_message() {
	global $wp_version;

	$insufficient_wp  = version_compare( $wp_version, GERITCHT_MINIMUM_WP_VERSION, '<' );
	$insufficient_php = version_compare( phpversion(), GERITCHT_MINIMUM_PHP_VERSION, '<' );

	if ( $insufficient_wp && $insufficient_php ) {
		/* translators: 1: required WP version number, 2: required PHP version number, 3: available WP version number, 4: available PHP version number */
		return sprintf( __( 'Geritcht Design requires at least WordPress version %1$s and PHP version %2$s. You are running versions %3$s and %3$s respectively. Please update and try again.', 'geritcht' ), GERITCHT_MINIMUM_WP_VERSION, GERITCHT_MINIMUM_PHP_VERSION, $wp_version, phpversion() );
	}

	if ( $insufficient_wp ) {
		/* translators: 1: required WP version number, 2: available WP version number */
		return sprintf( __( 'Geritcht Design requires at least WordPress version %1$s. You are running version %2$s. Please update and try again.', 'geritcht' ), GERITCHT_MINIMUM_WP_VERSION, $wp_version );
	}

	if ( $insufficient_php ) {
		/* translators: 1: required PHP version number, 2: available PHP version number */
		return sprintf( __( 'Geritcht Design requires at least PHP version %1$s. You are running version %2$s. Please update and try again.', 'geritcht' ), GERITCHT_MINIMUM_PHP_VERSION, phpversion() );
	}

	return '';
}

/**
 * Displays an error message if WP-CLI is used when requirements are not met.
 *
 * Exits script.
 */
if ( defined( 'WP_CLI' ) && WP_CLI ) {
	WP_CLI::error( geritcht_get_insufficient_requirements_message() );
}

/**
 * Prevents switching to the theme when requirements are not met.
 *
 * Switches to the default theme.
 */
function geritcht_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );

	add_action( 'admin_notices', 'geritcht_upgrade_notice' );
}
add_action( 'after_switch_theme', 'geritcht_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to the theme
 * when requirements are not met.
 */
function geritcht_upgrade_notice() {
	printf( '<div class="error"><p>%s</p></div>', esc_html( geritcht_get_insufficient_requirements_message() ) );
}

/**
 * Prevents the Customizer from being loaded when requirements are not met.
 */
function geritcht_customize() {
	wp_die(
		esc_html( geritcht_get_insufficient_requirements_message() ),
		'',
		array(
			'back_link' => true,
		)
	);
}
add_action( 'load-customize.php', 'geritcht_customize' );

/**
 * Prevents the Theme Preview from being loaded when requirements are not met.
 */
function geritcht_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( esc_html( geritcht_get_insufficient_requirements_message() ) );
	}
}
add_action( 'template_redirect', 'geritcht_preview' );
