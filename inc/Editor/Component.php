<?php
/**
 * Geritcht\Geritcht\Editor\Component class
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht\Editor;

use Geritcht\Geritcht\Component_Interface;
use function add_action;
use function add_theme_support;

/**
 * Class for integrating with the block editor.
 *
 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'editor';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'after_setup_theme', array( $this, 'action_add_editor_support' ) );
	}

	/**
	 * Adds support for various editor features.
	 */
	public function action_add_editor_support() {
		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for default block styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for wide-aligned images.
		add_theme_support( 'align-wide' );

		/**
		 * Add support for color palettes.
		 *
		 * To preserve color behavior across themes, use these naming conventions:
		 * - Use primary and secondary color for main variations.
		 * - Use `theme-[color-name]` naming standard for standard colors (red, blue, etc).
		 * - Use `custom-[color-name]` for non-standard colors.
		 *
		 * Add the line below to disable the custom color picker in the editor.
		 * add_theme_support( 'disable-custom-colors' );
		 */
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary', 'geritcht' ),
					'slug'  => 'theme-primary',
					'color' => '#e36d60',
				),
				array(
					'name'  => __( 'Secondary', 'geritcht' ),
					'slug'  => 'theme-secondary',
					'color' => '#41848f',
				),
				array(
					'name'  => __( 'Red', 'geritcht' ),
					'slug'  => 'theme-red',
					'color' => '#C0392B',
				),
				array(
					'name'  => __( 'Green', 'geritcht' ),
					'slug'  => 'theme-green',
					'color' => '#27AE60',
				),
				array(
					'name'  => __( 'Blue', 'geritcht' ),
					'slug'  => 'theme-blue',
					'color' => '#2980B9',
				),
				array(
					'name'  => __( 'Yellow', 'geritcht' ),
					'slug'  => 'theme-yellow',
					'color' => '#F1C40F',
				),
				array(
					'name'  => __( 'Black', 'geritcht' ),
					'slug'  => 'theme-black',
					'color' => '#1C2833',
				),
				array(
					'name'  => __( 'Grey', 'geritcht' ),
					'slug'  => 'theme-grey',
					'color' => '#95A5A6',
				),
				array(
					'name'  => __( 'White', 'geritcht' ),
					'slug'  => 'theme-white',
					'color' => '#ECF0F1',
				),
				array(
					'name'  => __( 'Dusty daylight', 'geritcht' ),
					'slug'  => 'custom-daylight',
					'color' => '#97c0b7',
				),
				array(
					'name'  => __( 'Dusty sun', 'geritcht' ),
					'slug'  => 'custom-sun',
					'color' => '#eee9d1',
				),
			)
		);

		/*
		 * Add support custom font sizes.
		 *
		 * Add the line below to disable the custom color picker in the editor.
		 * add_theme_support( 'disable-custom-font-sizes' );
		 */
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'geritcht' ),
					'shortName' => __( 'S', 'geritcht' ),
					'size'      => 16,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Medium', 'geritcht' ),
					'shortName' => __( 'M', 'geritcht' ),
					'size'      => 25,
					'slug'      => 'medium',
				),
				array(
					'name'      => __( 'Large', 'geritcht' ),
					'shortName' => __( 'L', 'geritcht' ),
					'size'      => 31,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Larger', 'geritcht' ),
					'shortName' => __( 'XL', 'geritcht' ),
					'size'      => 39,
					'slug'      => 'larger',
				),
			)
		);
	}
}
