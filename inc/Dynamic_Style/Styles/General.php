<?php

/**
 * Geritcht\Geritcht\Dynamic_Style\Styles\General class
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht\Dynamic_Style\Styles;

use Geritcht\Geritcht\Dynamic_Style\Component;
use function add_action;

class General extends Component
{
	public function __construct()
	{

		add_action('wp_enqueue_scripts', array($this, 'geritcht_create_general_style'), 20);
	}

	public function geritcht_create_general_style()
	{

		$geritcht_option = get_option('geritcht-options');
		$general_var = ':root { ';

		if (isset($geritcht_option['grid_container']) && !empty($geritcht_option['grid_container'])) {
			$general = $geritcht_option['grid_container']['width'];
			$general_var .= ' --content-width: ' . $general . ' !important;';
		}
		$general_var .= '}';
		if (isset($geritcht_option['body_set_option']) && $geritcht_option['body_set_option'] == 1) {
			if (
				isset($geritcht_option['body_color'])  && !empty($geritcht_option['body_color'])
			) {
				$general = $geritcht_option['body_color'];
				$general_var .= ' body { background : ' . $general . ' !important; }';
			}
		}
		if (isset($geritcht_option['body_set_option']) && $geritcht_option['body_set_option'] == 3) {
			if (isset($geritcht_option['body_image']['url']) && !empty($geritcht_option['body_image']['url'])) {
				$general = $geritcht_option['body_image']['url'];
				$general_var .= '
					body { background-image: url(' . $general . ') !important; }';
			}
		}

		if (isset($geritcht_option['back_to_top_btn']) && $geritcht_option['back_to_top_btn'] == 'no') {
			if (isset($geritcht_option['back_to_top_btn']) && !empty($geritcht_option['back_to_top_btn'])) {
				$general_var .= '
					#back-to-top { display: none !important; }';
			}
		}

		wp_add_inline_style('geritcht-global', $general_var);
	}
}
