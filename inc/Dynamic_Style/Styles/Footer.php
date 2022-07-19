<?php

/**
 * Geritcht\Geritcht\Dynamic_Style\Styles\Footer class
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht\Dynamic_Style\Styles;

use Geritcht\Geritcht\Dynamic_Style\Component;
use function add_action;

class Footer extends Component
{

	public function __construct()
	{
		add_action('wp_enqueue_scripts', array($this, 'geritcht_footer_dynamic_style'), 20);
	}

	public function geritcht_footer_dynamic_style()
	{

		$page_id = get_queried_object_id();
		$geritcht_options = get_option('geritcht-options');
		$footer_css = '';
		if (isset($geritcht_options['footer_top'])) {

			if ($geritcht_options['footer_top'] == 'no') {
				$footer_css = '.footer-top { 
					display : none !important;
				}';
			}
		}

		if (isset($geritcht_options['change_footer_color'])) {

			if (isset($geritcht_options['footer_bg_color']) && $geritcht_options['change_footer_color'] == '0') {
				$footer_bg_color = $geritcht_options['footer_bg_color'];
				$footer_css .= ".footer {
					background-color: $footer_bg_color !important;
				}";
			}
		}
	

		wp_add_inline_style('geritcht-global', $footer_css);
	}
}
