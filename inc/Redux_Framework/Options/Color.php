<?php
/**
 * Geritcht\Geritcht\Redux_Framework\Options\Color class
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht\Redux_Framework\Options;

use Redux;
use Geritcht\Geritcht\Redux_Framework\Component;

class Color extends Component {

	public function __construct() {
		$this->set_widget_option();
	}

	protected function set_widget_option() {
		Redux::set_section( $this->opt_name, array(
			'title' => esc_html__( 'Color Attribute','geritcht' ),
			'id'    => 'color',
			'icon'  => 'el el-brush',
			'desc'  => esc_html__('Change the default colors of your site.','geritcht'),
			'fields'=> array(
				array(
					'id'       => 'custom_color_switch',
					'type'     => 'button_set',
					'title'    => esc_html__('Set Custom Color', 'geritcht'),
					'options' => array(
						'yes' => 'Yes',
						'no' => 'No',
					),
					'default' => 'no'
				),

				array(
					'id'            => 'primary_color',
					'type'          => 'color',
					'title'         => esc_html__( 'Set Primary Color', 'geritcht' ),
					'subtitle'      => esc_html__( 'Select primary accent color.', 'geritcht' ),
					'mode'          => 'background',
					'transparent'   => false,
					'required'      => array('custom_color_switch' ,'=' , 'yes')
				),

				array(
					'id'            => 'secondary_color',
					'type'          => 'color',
					'title'         => esc_html__( 'Set Secondary Color', 'geritcht' ),
					'subtitle'      => esc_html__( 'Select secondary complementing color.', 'geritcht' ),
					'mode'          => 'background',
					'transparent'   => false,
					'required'      => array('custom_color_switch' ,'=' , 'yes')
				),

				array(
					'id'            => 'title_color',
					'type'          => 'color',
					'title'         => esc_html__( 'Title Color', 'geritcht' ),
					'subtitle'      => esc_html__( 'Select default Title(Headings) color', 'geritcht' ),
					'mode'          => 'background',
					'transparent'   => false,
					'required'      => array('custom_color_switch' ,'=' , 'yes')
				),


				array(
					'id'            => 'text_color',
					'type'          => 'color',
					'title'         => esc_html__( 'Body Text Color', 'geritcht' ),
					'subtitle'      => esc_html__( 'Select default body text color', 'geritcht' ),
					'mode'          => 'background',
					'transparent'   => false,
					'required'      => array('custom_color_switch' ,'=' , 'yes')
				),

			)
		));
	}
}
