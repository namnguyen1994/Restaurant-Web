<?php

/**
 * Geritcht\Geritcht\Dynamic_Style\Styles\Banner class
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht\Dynamic_Style\Styles;

use Geritcht\Geritcht\Dynamic_Style\Component;
use function add_action;

class Color extends Component
{

	public function __construct()
	{
		add_action('wp_enqueue_scripts', array($this, 'geritcht_color_options'), 20);
		add_action('wp_enqueue_scripts', array($this, 'geritcht_banner_title_color'), 20);
		add_action('wp_enqueue_scripts', array($this, 'geritcht_layout_color'), 20);
		add_action('wp_enqueue_scripts', array($this, 'geritcht_loader_color'), 20);
		add_action('wp_enqueue_scripts', array($this, 'geritcht_bg_color'), 20);
		add_action('wp_enqueue_scripts', array($this, 'geritcht_opacity_color'), 20);
		add_action('wp_enqueue_scripts', array($this, 'geritcht_header_radio'), 20);
		add_action('wp_enqueue_scripts', array($this, 'geritcht_footer_color'), 20);
	}

	public function geritcht_color_options()
	{

		$geritcht_option = get_option('geritcht-options');
		if (class_exists('ReduxFramework')) {
			$color_var = ':root { ';
			
			if (isset($geritcht_option['custom_color_switch']) && $geritcht_option['custom_color_switch'] == 'yes' && isset($geritcht_option['primary_color']) && !empty($geritcht_option['primary_color'])) {
				$color = $geritcht_option['primary_color'];
				$color_var .= '--color-theme-primary: ' . $color . ' !important;';
			}

			if (isset($geritcht_option['custom_color_switch']) && $geritcht_option['custom_color_switch'] == 'yes' && isset($geritcht_option['secondary_color']) && !empty($geritcht_option['secondary_color'])) {
				$color = $geritcht_option['secondary_color'];
				$color_var .= '--color-theme-secondary: ' . $color . ' !important;';
			}
			
			if (isset($geritcht_option['custom_color_switch']) && $geritcht_option['custom_color_switch'] == 'yes' && isset($geritcht_option['text_color']) && !empty($geritcht_option['text_color'])) {
				$color = $geritcht_option['text_color'];
				$color_var .= '--global-font-color: ' . $color . ' !important;';
			}

			if (isset($geritcht_option['custom_color_switch']) && $geritcht_option['custom_color_switch'] == 'yes' && isset($geritcht_option['title_color']) && !empty($geritcht_option['title_color'])) {
				$color = $geritcht_option['title_color'];
				$color_var .= ' --global-font-title: ' . $color . ' !important;';
			}

			$color_var .= '}';
			wp_add_inline_style('geritcht-global', $color_var);
		}
	}

	public function geritcht_banner_title_color()
	{
		//Set Body Color
		$geritcht_option = get_option('geritcht-options');

		if (!empty($geritcht_option['bg_title_color'])) {
			$bg_title_color = $geritcht_option['bg_title_color'];
		}

		$bn_title_color = "";

		if (!empty($bg_title_color)) {
			$bn_title_color .= "
        .geritcht-breadcrumb-one .title{
            color: $bg_title_color !important;
        }";
		}
		wp_add_inline_style('geritcht-global', $bn_title_color);
	}

	public function geritcht_layout_color()
	{
		//Set Body Color
		$geritcht_option = get_option('geritcht-options');

		if (!empty($geritcht_option['geritcht_layout_color'])) {
			$geritcht_layout_color = $geritcht_option['geritcht_layout_color'];
		}
		$body_accent_color = "";

		if (isset($body_back_color) && !empty($body_back_color)) {
			$body_accent_color .= "
        body {
            background-color: $body_back_color !important;
        }";
		} else if (!empty($geritcht_option['layout_set']) && $geritcht_option['layout_set'] == "1" && $key_body_bg_col['body_variation'] != 'default') {
			if (!empty($geritcht_layout_color) && $geritcht_layout_color != '#ffffff') {
				$body_accent_color .= "
            body {
                background-color: $geritcht_layout_color !important;
            }";
			}
		} else {
			$body_accent_color = "";
		}

		wp_add_inline_style('geritcht-style', $body_accent_color);
	}

	public function geritcht_loader_color()
	{
		//Set Loader Background Color
		$geritcht_option = get_option('geritcht-options');

		if (!empty($geritcht_option['loader_color'])) {
			$loader_color = $geritcht_option['loader_color'];
		}
		$ld_color = "";

		if (!empty($loader_color) && $loader_color != '#ffffff') {
			$ld_color .= "#loading {
								background : $loader_color !important;
							}";
		}
		wp_add_inline_style('geritcht-style', $ld_color);
	}

	public function geritcht_bg_color()
	{
		//Set Background Color
		$geritcht_option = get_option('geritcht-options');

		if (!empty($geritcht_option['bg_color'])) {
			$bg_color = $geritcht_option['bg_color'];
		}
		$background_color = "";

		if (!empty($geritcht_option['bg_type']) && $geritcht_option['bg_type'] == "1") {
			if (!empty($bg_color) && $bg_color != '#ffffff') {
				$background_color .= "
            .geritcht-bg-over {
                background : $bg_color !important;
            }";
			}
		}
		wp_add_inline_style('geritcht-style', $background_color);
	}

	public function geritcht_opacity_color()
	{
		//Set Background Opacity Color
		$geritcht_option = get_option('geritcht-options');

		if (!empty($geritcht_option['bg_opacity']) && $geritcht_option['bg_opacity'] == "3") {
			$bg_opacity = $geritcht_option['opacity_color']['rgba'];
		}
		$op_color = "";

		if (!empty($geritcht_option['bg_opacity']) && $geritcht_option['bg_opacity'] == "3") {
			if (!empty($bg_opacity) && $bg_opacity != '#ffffff') {
				$op_color .= "
        .breadcrumb-video::before,.breadcrumb-bg::before, .breadcrumb-ui::before {
            background : $bg_opacity !important;
        }";
			}
		}
		wp_add_inline_style('geritcht-style', $op_color);
	}

	public function geritcht_header_radio()
	{
		//Set Text Logo Color
		$geritcht_option = get_option('geritcht-options');

		if (!empty($geritcht_option['header_color'])) {
			$logo = $geritcht_option['header_color'];
		}
		$logo_color = "";

		if (!empty($geritcht_option['header_radio']) && $geritcht_option['header_radio'] == "1") {
			if (!empty($logo) && $logo != '#ffffff') {
				$logo_color .= "
            .logo-text {
                color : $logo !important;
            }";
			}
		}
		wp_add_inline_style('geritcht-style', $logo_color);
	}

	public function geritcht_footer_color()
	{
		//Set Footer Background Color
		$geritcht_option = get_option('geritcht-options');

		if (!empty($geritcht_option['change_footer_color']) && $geritcht_option['change_footer_color'] == "0") {
			$f_color = $geritcht_option['footer_color'];
		}
		$footer_color = "";
		if (!empty($geritcht_option['change_footer_color']) && $geritcht_option['change_footer_color'] == "0") {
			if (!empty($f_color) && $f_color != '#ffffff') {
				$footer_color .= "
            .geritcht-over-dark-90 {
                background : $f_color !important;
            }";
			}
		} else {
			$footer_color = '';
		}

		wp_add_inline_style('geritcht-style', $footer_color);
	}
}
