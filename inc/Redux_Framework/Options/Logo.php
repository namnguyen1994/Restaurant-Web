<?php
/**
 * Geritcht\Geritcht\Redux_Framework\Options\Logo class
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht\Redux_Framework\Options;
use Redux;
use Geritcht\Geritcht\Redux_Framework\Component;

class Logo extends Component {

	public function __construct() {
		$this->set_widget_option();
	}

	protected function set_widget_option() {
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Logo','geritcht'),
			'id'    => 'header-logo',
			'icon'  => 'el el-flag',
			'fields'=> array(
		
				array(
					'id'       => 'header_radio',
					'type'     => 'button_set',
					'title'    => esc_html__( 'Select Logo Type', 'geritcht' ),
					'subtitle' => esc_html__( 'Select either Text or image for your Logo.', 'geritcht' ),
					'options'  => array(
						'1' => ' Logo as Text',
						'2' => ' Logo as Image',
					),
					'default'  => '2'
				),
		
				array(
					'id'       => 'header_text',
					'type'     => 'text',
					'title'    => esc_html__( 'Logo Text', 'geritcht' ),
					'desc'     => esc_html__( 'Enter the text to be used instead of the logo image', 'geritcht' ),
					'required'  => array( 'header_radio', '=', '1' ),
					'msg'      => esc_html__('Please enter correct value','geritcht' ),
					'default'  => esc_html__('geritcht','geritcht' ),
				),
		
				array(
					'id'            => 'header_color',
					'type'          => 'color',
					'title'         => esc_html__( 'Text Color', 'geritcht' ),
					'subtitle'      => esc_html__( 'Choose Text Color', 'geritcht' ),
					'required'      => array( 'header_radio', '=', '1' ),
					'default'       =>'#ffffff',
					'mode'          => 'background',
					'transparent'   => false
				),
		        array(
					'id' => 'geritcht_header_logo_section',
					'type' => 'section',
					'title'=>  esc_html__('Logo', 'geritcht'),
					'indent' => true,
					'required'  => array( 'header_radio', '=', '2' ),
				) ,
		
				array(
					'id'       => 'geritcht_logo',
					'type'     => 'media',
					'url'      => false,
					'title'    => esc_html__( 'Logo','geritcht'),
					'required'  => array( 'header_radio', '=', '2' ),
					'read-only'=> false,
					'default'  => array( 'url' => get_template_directory_uri() .'/assets/images/logo.svg' ),
					'subtitle' => esc_html__( 'Upload Logo image for your Website. Otherwise site title will be displayed in place of Logo.','geritcht'),
				),
		
				array(
					'id'       => 'geritcht_mobile_logo',
					'type'     => 'media',
					'url'      => false,
					'title'    => esc_html__( 'Responsive Logo','geritcht'),
					'required'  => array( 'header_radio', '=', '2' ),
					'read-only'=> false,
					'default'  => array( 'url' => get_template_directory_uri() .'/assets/images/logo-white.svg' ),
					'subtitle' => esc_html__( 'Upload Logo image for your Website. Otherwise site title will be displayed in place of Logo.','geritcht'),
				),
			)
		));
	}
}
