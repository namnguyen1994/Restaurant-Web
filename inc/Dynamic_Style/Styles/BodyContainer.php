<?php
/**
 * Geritcht\Geritcht\Dynamic_Style\Styles\BodyContainer class
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht\Dynamic_Style\Styles;

use Geritcht\Geritcht\Dynamic_Style\Component;
use function add_action;

class BodyContainer extends Component
{

	public function __construct()
	{
		if (class_exists('ReduxFramework')) {
			add_action('wp_enqueue_scripts', array( $this,'geritcht_container_width'), 21);
		}
	}

	public function geritcht_container_width()
	{
		$geritcht_options = get_option('geritcht-options');

		$box_container_width = "";

		if (isset($geritcht_options['opt-slider-label']) && !empty($geritcht_options['opt-slider-label'])) {

			$container_width = $geritcht_options['opt-slider-label'];

			$box_container_width = "body.iq-container-width .container,
        							body.iq-container-width .elementor-section.elementor-section-boxed>
        							.elementor-container { max-width: " . $container_width . "px; } ";
		}


		wp_add_inline_style('geritcht-style',
			$box_container_width
		);
	}
}
