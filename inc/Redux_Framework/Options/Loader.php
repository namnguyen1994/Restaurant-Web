<?php
/**
 * Geritcht\Geritcht\Redux_Framework\Options\Loader class
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht\Redux_Framework\Options;
use Redux;
use Geritcht\Geritcht\Redux_Framework\Component;

class Loader extends Component {

	public function __construct() {
		$this->set_widget_option();
	}

	protected function set_widget_option() {
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Loader', 'geritcht'),
			'id' => 'loader',
			'icon' => 'el el-refresh',
			'fields' => array(

				array(
					'id' => 'display_loader',
					'type' => 'button_set',
					'title' => esc_html__('geritcht Loader', 'geritcht'),
					'subtitle' => wp_kses('Turn on to show the icon/images loading animation while your site loads', 'geritcht'),
					'options' => array(
						'yes' => esc_html__('Yes', 'geritcht'),
						'no' => esc_html__('No', 'geritcht')
					),
					'default' => esc_html__('yes', 'geritcht')
				),

				array(
					'id' => 'loader_bg_color',
					'type' => 'color',
					'title' => esc_html__('Loader Background Color', 'geritcht'),
					'required' => array('display_loader', '=', 'yes'),
					'subtitle' => esc_html__('Choose Loader Background Color', 'geritcht'),
					'default' => '#ffffff',
					'transparent' => false
				),

				array(
					'id' => 'loader_gif',
					'type' => 'media',
					'url' => true,
					'title' => esc_html__('Add GIF image for loader', 'geritcht'),
					'read-only' => false,
					'required' => array('display_loader', '=', 'yes'),
					'default' => array('url' => get_template_directory_uri() . '/assets/images/redux/loader.gif'),
					'subtitle' => esc_html__('Upload Loader GIF image for your Website.', 'geritcht'),
				),

				array(
					'id' => 'loader-dimensions',
					'type' => 'dimensions',
					'units' => array('em', 'px', '%'),
					'units_extended' => 'true',
					'required' => array('display_loader', '=', 'yes'),
					'title' => esc_html__('Loader (Width/Height) Option', 'geritcht'),
					'subtitle' => esc_html__('Allows you to choose width, height, and/or unit.', 'geritcht'),
					'desc' => esc_html__('You can enable or disable any piece of this field. Width, Height, or Units.', 'geritcht'),
				),
			)
		));
	}
}
