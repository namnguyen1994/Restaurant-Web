<?php

/**
 * Geritcht\Geritcht\Dynamic_Style\Styles\Header class
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht\Dynamic_Style\Styles;

use Geritcht\Geritcht\Dynamic_Style\Component;
use function add_action;


class Header extends Component
{

	public function __construct()
	{
		add_action('wp_enqueue_scripts', array($this, 'geritcht_header_background_style'), 20);
		add_action('wp_enqueue_scripts', array($this, 'geritcht_menu_color_options'), 20);
		add_action('wp_enqueue_scripts', array($this, 'geritcht_sub_menu_color_options'), 20);
		add_action('wp_enqueue_scripts', array($this, 'geritcht_burger_menu_color_options'), 20);
		add_action('wp_enqueue_scripts', array($this, 'geritcht_action_btn_color_options'), 20);
	}

	public function geritcht_header_background_style()
	{
		$geritcht_option = get_option('geritcht-options');
		$dynamic_css = '';

		if (isset($geritcht_option['geritcht_header_background_type'])) {
			if (isset($geritcht_option['geritcht_header_background_type']) && $geritcht_option['geritcht_header_background_type'] != 'default') {
				$type = $geritcht_option['geritcht_header_background_type'];
				if ($type == 'color') {
					if (!empty($geritcht_option['geritcht_header_background_color'])) {
						$dynamic_css = 'header#default-header{
							background : ' . $geritcht_option['geritcht_header_background_color'] . '!important;
						}';
					}
				}
				if ($type == 'image') {
					if (!empty($geritcht_option['geritcht_header_background_image']['url'])) {
						$dynamic_css = 'header#default-header{
							background : url(' . $geritcht_option['geritcht_header_background_image']['url'] . ') !important;
						}';
					}
				}
				if ($type == 'transparent') {
					$dynamic_css = 'header#default-header{
						background : transparent !important;
					}';
				}
			}
		}
		wp_add_inline_style('geritcht-global', $dynamic_css);
	}

	public function geritcht_menu_color_options()
	{

		$geritcht_option =  get_option('geritcht-options');
		$inline_css = '';

		if (!empty($geritcht_option['menu_color']) && $geritcht_option['menu_color'] == "custom") {

			if (isset($geritcht_option['header_menu_color']) && !empty($geritcht_option['header_menu_color'])) {
				$inline_css .= '.sf-menu > li > a{
						color : ' . $geritcht_option['header_menu_color'] . '!important;
					}';
			}

			if (isset($geritcht_option['hover_menu_color']) && !empty($geritcht_option['hover_menu_color'])) {
				$inline_css .= '.sf-menu li:hover > a,.sf-menu li.current-menu-ancestor > a,.sf-menu  li.current-menu-item > a{
						color : ' . $geritcht_option['hover_menu_color'] . ' !important;
					}';
			}
		}



		wp_add_inline_style('geritcht-global', $inline_css);
	}

	public function geritcht_sub_menu_color_options()
	{
		$geritcht_option = get_option('geritcht-options');
		$inline_css = '';
		if (isset($geritcht_option['header_submenu_color_type']) && $geritcht_option['header_submenu_color_type'] == 'custom') {
			if (isset($geritcht_option['submenu_color']) && !empty($geritcht_option['submenu_color'])) {
				$inline_css .= '.sf-menu ul.sub-menu a{
                   		color : ' . $geritcht_option['submenu_color'] . ' !important; }';
			}

			if (isset($geritcht_option['hover_submenu_color']) && !empty($geritcht_option['hover_submenu_color'])) {
				$inline_css .= '.sf-menu li.sfHover>a, .sf-menu li:hover>a,.sf-menu li.current-menu-ancestor>a, .sf-menu li.current-menu-item>a, .sf-menu ul>li.menu-item.current-menu-parent>a,.sf-menu ul li.current-menu-parent>a, .sf-menu ul li .sub-menu li.current-menu-item>a
                					{  color : ' . $geritcht_option['hover_submenu_color'] . ' !important;  }';
			}

			if (isset($geritcht_option['submenu_background_color']) && !empty($geritcht_option['submenu_background_color'])) {
				$inline_css .= '.sf-menu ul.sub-menu li{
                   background : ' . $geritcht_option['submenu_background_color'] . ' !important;  }';
			}

			if (isset($geritcht_option['hover_submenu_bg_color']) && !empty($geritcht_option['hover_submenu_bg_color'])) {
				$inline_css .= '.sf-menu ul.sub-menu li:hover,.sf-menu ul.sub-menu li.current-menu-item{
                   background : ' . $geritcht_option['hover_submenu_bg_color'] . ' !important;   }';
			}
		}
		wp_add_inline_style('geritcht-global', $inline_css);
	}

	public function geritcht_burger_menu_color_options()
	{
		$geritcht_option = get_option('geritcht-options');
		$inline_css = '';

		if (isset($geritcht_option['burger_menu_button_type']) && $geritcht_option['burger_menu_button_type'] == 'custom') {

			if (isset($geritcht_option['burger_menu_icon']) && !empty($geritcht_option['burger_menu_icon'])) {
				$inline_css .= ' .menu-btn .line {
                    background-color : ' . $geritcht_option['burger_menu_icon'] . ' !important;
                }';
			}

			if (isset($geritcht_option['burger_menu_popup_bg']) && !empty($geritcht_option['burger_menu_popup_bg'])) {
				$inline_css .= ' .geritcht-mobile-menu {
                    background : ' . $geritcht_option['burger_menu_popup_bg'] . ' !important;
                }';
			}
			

			if (isset($geritcht_option['burger_menu_color']) && !empty($geritcht_option['burger_menu_color'])) {
				$inline_css .= '.geritcht-mobile-menu .navbar-nav > li > a, .geritcht-mobile-menu .navbar-nav li > .toggledrop svg{ 
					color : ' . $geritcht_option['burger_menu_color'] . ' !important;
				}';
			}


			if (isset($geritcht_option['burger_hover_menu_color']) && !empty($geritcht_option['burger_hover_menu_color'])) {
				$inline_css .= '.geritcht-mobile-menu .navbar-nav li.current-menu-item > .toggledrop svg, .geritcht-mobile-menu .navbar-nav li.current-menu-item > a, .geritcht-mobile-menu .navbar-nav li .sub-menu li:hover > a, .geritcht-mobile-menu .navbar-nav li:hover > .toggledrop svg, .geritcht-mobile-menu .navbar-nav li:hover > a, .geritcht-mobile-menu ul > li.current-menu-ancestor > .toggledrop svg, .geritcht-mobile-menu ul > li.current-menu-ancestor > a, .geritcht-mobile-menu ul li .sub-menu li.current-menu-item > a, .geritcht-mobile-menu ul li .sub-menu li.menu-item.current-menu-ancestor > a{
			        color : ' . $geritcht_option['burger_hover_menu_color'] . ' !important;
				}';
			}

			if (isset($geritcht_option['burger_submenu_color']) && !empty($geritcht_option['burger_submenu_color'])) {
				$inline_css .= '.geritcht-mobile-menu .navbar-nav li .sub-menu li a , .geritcht-mobile-menu .navbar-nav li .sub-menu li svg{
			        color : ' . $geritcht_option['burger_submenu_color'] . ' !important;
				}';
			}
		}
		wp_add_inline_style('geritcht-global', $inline_css);
	}

	public function geritcht_action_btn_color_options()
	{
		$geritcht_option = get_option('geritcht-options');
		$inline_css = '';

		if (isset($geritcht_option['button_color']) && $geritcht_option['button_color'] == 'custom') {

			if (isset($geritcht_option['button_bg_color']) && !empty($geritcht_option['button_bg_color'])) {
				$inline_css .= '
            header .geritcht-shop-btn-holder  #btn-search svg,header .search_count #btn-search{
                color : ' . $geritcht_option['button_bg_color'] . ' !important;
            }';
			}
		}

		if (!empty($inline_css)) {
			wp_add_inline_style('geritcht-global', $inline_css);
		}
	}
}
