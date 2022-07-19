<?php

/**
 * Geritcht\Geritcht\Redux_Framework\Options\General class
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht\Redux_Framework\Options;

use Redux;
use Geritcht\Geritcht\Redux_Framework\Component;

class Header extends Component
{

	public function __construct()
	{
		$this->set_widget_option();
	}
	public function get_hf_layout()
	{
		$args = array(
			'post_type'         => 'iqonic_hf_layout',
			'post_status'       => 'publish',
			'posts_per_page'    => -1,
			'meta_key'          => '_layout_meta_key',
			'meta_value'        => 'header',
		);
		global $post;
		$wp_query = get_posts($args);
		$iqonic_header_list = [];

		if ($wp_query) {
			foreach ($wp_query as $header) {
				$iqonic_header_list[$header->post_name] = $header->post_title;
			}
			return $iqonic_header_list;
		}
	}
	protected function set_widget_option()
	{
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Header', 'geritcht'),
			'id' => 'header',
			'icon' => 'el el-arrow-up',
			'customizer_width' => '500px',
		));

		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Header Layout', 'geritcht'),
			'id' => 'header_variation',
			'subsection' => true,
			'desc' => esc_html__('This section contains options for Menu .', 'geritcht'),
			'fields' => array(

				array(
					'id' => 'header_layout',
					'type' => 'button_set',
					'title' => esc_html__('Header Layout', 'geritcht'),
					'options' => array(
						'default' => esc_html__('Default', 'geritcht'),
						'custom' => esc_html__('Custom', 'geritcht'),
					),
					'default' => 'default'
				),

				array(
					'id' => 'header_container',
					'type' => 'button_set',
					'title' => esc_html__('Header container', 'geritcht'),
					'options' => array(
						'container-fluid' => esc_html__('full width', 'geritcht'),
						'container' => esc_html__('Container', 'geritcht'),
					),
					'default' => 'container-fluid'
				),


				array(
					'id' => 'header_postion',
					'type' => 'button_set',
					'title' => esc_html__('Header Position', 'geritcht'),
					'options' => array(
						'default' => esc_html__('Default', 'geritcht'),
						'over' => esc_html__('Over', 'geritcht'),
					),
					'default' => 'default'
				),


				// --------main header background options start----------//

				array(
					'id' => 'geritcht_header_background_type',
					'type' => 'button_set',
					'title' => esc_html__('Background', 'geritcht'),
					'subtitle' => esc_html__('Select the variation for header background', 'geritcht'),
					'options' => array(
						'default' => esc_html__('Default', 'geritcht'),
						'color' => esc_html__('Color', 'geritcht'),
						'image' => esc_html__('Image', 'geritcht'),
						'transparent' => esc_html__('Transparent', 'geritcht')
					),
					'default' => esc_html__('default', 'geritcht')
				),

				array(
					'id' => 'geritcht_header_background_color',
					'type' => 'color',
					'desc' => esc_html__('Set Background Color', 'geritcht'),
					'required' => array('geritcht_header_background_type', '=', 'color'),
					'mode' => 'background',
					'transparent' => false
				),

				array(
					'id' => 'geritcht_header_background_image',
					'type' => 'media',
					'url' => false,
					'desc' => esc_html__('Upload Image', 'geritcht'),
					'required' => array('geritcht_header_background_type', '=', 'image'),
					'read-only' => false,
					'subtitle' => esc_html__('Upload background image for header.', 'geritcht'),
				),

				// --------main header Background options end----------//

				// --------main header Menu options start----------//
				array(
					'id' => 'menu_color',
					'type' => 'button_set',
					'title' => esc_html__('Menu Color Options', 'geritcht'),
					'subtitle' => esc_html__('Select Menu color .', 'geritcht'),
					'options' => array(
						'default' => esc_html__('Default', 'geritcht'),
						'custom' => esc_html__('Custom', 'geritcht'),
					),
					'default' => esc_html__('default', 'geritcht')
				),
				array(
					'id' => 'header_menu_color',
					'type' => 'color',
					'required' => array('menu_color', '=', 'custom'),
					'desc' => esc_html__('Menu Color', 'geritcht'),
					'mode' => 'background',
					'transparent' => false
				),


				array(
					'id' => 'hover_menu_color',
					'type' => 'color',
					'required' => array('menu_color', '=', 'custom'),
					'desc' => esc_html__('Menu Hover Color', 'geritcht'),
					'mode' => 'background',
					'transparent' => false
				),

				//----sub menu options start---//
				array(
					'id' => 'header_submenu_color_type',
					'type' => 'button_set',
					'title' => esc_html__('Submenu Color Options', 'geritcht'),
					'subtitle' => esc_html__('Select submenu color.', 'geritcht'),
					'options' => array(
						'default' => esc_html__('Default', 'geritcht'),
						'custom' => esc_html__('Custom', 'geritcht'),
					),
					'default' => esc_html__('default', 'geritcht')
				),

				array(
					'id' => 'submenu_color',
					'type' => 'color',
					'desc' => esc_html__('Submenu Color', 'geritcht'),
					'required' => array('header_submenu_color_type', '=', 'custom'),
					'mode' => 'background',
					'transparent' => false
				),


				array(
					'id' => 'hover_submenu_color',
					'type' => 'color',
					'desc' => esc_html__('Submenu Hover Color', 'geritcht'),
					'required' => array('header_submenu_color_type', '=', 'custom'),
					'mode' => 'background',
					'transparent' => false
				),

				array(
					'id' => 'submenu_background_color',
					'type' => 'color',
					'desc' => esc_html__('Submenu Background Color', 'geritcht'),
					'required' => array('header_submenu_color_type', '=', 'custom'),
					'mode' => 'background',
					'transparent' => false
				),

				array(
					'id' => 'hover_submenu_bg_color',
					'type' => 'color',
					'desc' => esc_html__('Submenu Background Hover Color', 'geritcht'),
					'required' => array('header_submenu_color_type', '=', 'custom'),
					'mode' => 'background',
					'transparent' => false
				),
				//----sub menu options end----//


				// --------main header Menu options end----------//

				// --------main header responsive Menu Button Options start----------//
				array(
					'id' => 'burger_menu_button_type',
					'type' => 'button_set',
					'title' => esc_html__('Burger Menu', 'geritcht'),
					'subtitle' => esc_html__('Select color for burger Menu', 'geritcht'),
					'options' => array(
						'default' => esc_html__('Default', 'geritcht'),
						'custom' => esc_html__('Custom', 'geritcht')
					),
					'default' => 'default'
				),

				array(
					'id' => 'burger_menu_icon',
					'type' => 'color',
					'desc' => esc_html__('Toggle Icon color', 'geritcht'),
					'required' => array('burger_menu_button_type', '=', 'custom'),
					'mode' => 'background',
					'transparent' => false
				),

				array(
					'id' => 'burger_menu_popup_bg',
					'type' => 'color',
					'desc' => esc_html__('Model Background color', 'geritcht'),
					'required' => array('burger_menu_button_type', '=', 'custom'),
					'mode' => 'background',
					'transparent' => false
				),

				array(
					'id' => 'burger_menu_color',
					'type' => 'color',
					'desc' => esc_html__('Menu color', 'geritcht'),
					'required' => array('burger_menu_button_type', '=', 'custom'),
					'mode' => 'background',
					'transparent' => false
				),

				array(
					'id' => 'burger_hover_menu_color',
					'type' => 'color',
					'desc' => esc_html__('Menu hover color', 'geritcht'),
					'required' => array('burger_menu_button_type', '=', 'custom'),
					'mode' => 'background',
					'transparent' => false
				),

				array(
					'id' => 'burger_submenu_color',
					'type' => 'color',
					'desc' => esc_html__('Sub Menu Color', 'geritcht'),
					'required' => array('burger_menu_button_type', '=', 'custom'),
					'mode' => 'background',
					'transparent' => false
				),


				// --------main header responsive Menu Button Options end----------//

				// --------main header Search Options start----------//
				array(
					'id' => 'header_display_button',
					'type' => 'button_set',
					'title' => esc_html__('Display Search Icon', 'geritcht'),
					'subtitle' => esc_html__('Turn on to display the Search in header.', 'geritcht'),
					'options' => array(
						'yes' => esc_html__('On', 'geritcht'),
						'no' => esc_html__('Off', 'geritcht')
					),
					'default' => esc_html__('yes', 'geritcht')
				),

				array(
					'id' => 'header_search_text',
					'type' => 'text',
					'title' => esc_html__('Search Text', 'geritcht'),
					'required' => array('header_display_button', '=', 'yes'),
					'validate' => 'text',
					'default' => esc_html__('Search', 'geritcht'),
					'subtitle' => esc_html__('Enter Header Search Text .', 'geritcht'),
				),

				array(
					'id' => 'button_color',
					'type' => 'button_set',
					'required' => array('header_display_button', '=', 'yes'),
					'title' => esc_html__('Search Icon', 'geritcht'),
					'subtitle' => esc_html__('Turn on to display the Search color in header.', 'geritcht'),
					'options' => array(
						'default' => esc_html__('Default', 'geritcht'),
						'custom' => esc_html__('Custom', 'geritcht')
					),
					'default' => esc_html__('default', 'geritcht')
				),

				array(
					'id' => 'button_bg_color',
					'type' => 'color',
					'desc' => esc_html__('Icon color', 'geritcht'),
					'required' => array('button_color', '=', 'custom'),
					'desc' => esc_html__('Select for button color options.', 'geritcht'),
					'mode' => 'background',
					'transparent' => false
				),

				// --------main header Search Options end----------//
			)
		));

		//-----Sticky Header Options Start---//
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Sticky Header', 'geritcht'),
			'id' => 'geritcht_sticky-header-variation',
			'subsection' => true,
			'desc' => esc_html__('This section contains options for sticky header menu and background color.', 'geritcht'),
			'fields' => array(

				array(
					'id' => 'display_sticky_header',
					'type' => 'button_set',
					'title' => esc_html__('Sticky Header', 'geritcht'),
					'subtitle' => esc_html__('Turn on to display sticky header.', 'geritcht'),
					'options' => array(
						'yes' => esc_html__('On', 'geritcht'),
						'no' => esc_html__('Off', 'geritcht')
					),
					'default' => esc_html__('yes', 'geritcht')
				),
				// --------sticky header background options start----------//
				array(
					'id' => 'sticky_header_bg',
					'type' => 'button_set',
					'required' => array('display_sticky_header', '=', 'yes'),
					'title' => esc_html__('Background', 'geritcht'),
					'subtitle' => esc_html__('Select the variation for sticky header background', 'geritcht'),
					'options' => array(
						'default' => esc_html__('Default', 'geritcht'),
						'color' => esc_html__('Color', 'geritcht'),
						'image' => esc_html__('Image', 'geritcht'),
						'transparent' => esc_html__('Transparent', 'geritcht')
					),
					'default' => esc_html__('default', 'geritcht')
				),

				array(
					'id' => 'sticky_header_bg_color',
					'type' => 'color',
					'desc' => esc_html__('Set Background Color', 'geritcht'),
					'required' => array('sticky_header_bg', '=', 'color'),
					'mode' => 'background',
					'transparent' => false
				),

				array(
					'id' => 'sticky_header_bg_img',
					'type' => 'media',
					'url' => false,
					'desc' => esc_html__('Upload Image', 'geritcht'),
					'required' => array('sticky_header_bg', '=', 'image'),
					'read-only' => false,
					'subtitle' => esc_html__('Upload background image for sticky header.', 'geritcht'),
				),
				// --------sticky header Background options end----------//
				// --------sticky header Menu options start----------//

				array(
					'id'        => 'sticky_menu_color_type',
					'type'      => 'button_set',
					'required'  => array('display_sticky_header', '=', 'yes'),
					'title'     => esc_html__('Menu Color Options', 'geritcht'),
					'subtitle' => esc_html__('Select Menu color for sticky.', 'geritcht'),
					'options'   => array(
						'default' => esc_html__('Default', 'geritcht'),
						'custom' => esc_html__('Custom', 'geritcht'),
					),
					'default'   => esc_html__('default', 'geritcht')
				),
				array(
					'id'            => 'sticky_menu_color',
					'type'          => 'color',
					'required'  => array('sticky_menu_color_type', '=', 'custom'),
					'desc'     => esc_html__('Menu color', 'geritcht'),
					'mode'          => 'background',
					'transparent'   => false
				),

				array(
					'id'            => 'sticky_menu_hover_color',
					'type'          => 'color',
					'required'  => array('sticky_menu_color_type', '=', 'custom'),
					'desc'     => esc_html__('Menu hover color', 'geritcht'),
					'mode'          => 'background',
					'transparent'   => false
				),

				//----sticky sub menu options start---//
				array(
					'id'        => 'sticky_header_submenu_color_type',
					'type'      => 'button_set',
					'title'     => esc_html__('Submenu Color Options', 'geritcht'),
					'subtitle' => esc_html__('Select submenu color for sticky.', 'geritcht'),
					'required'  => array('display_sticky_header', '=', 'yes'),
					'options'   => array(
						'default' => esc_html__('Default', 'geritcht'),
						'custom' => esc_html__('Custom', 'geritcht'),
					),
					'default'   => esc_html__('default', 'geritcht')
				),

				array(
					'id'            => 'sticky_geritcht_header_submenu_color',
					'type'          => 'color',
					'desc'     => esc_html__('Submenu Color', 'geritcht'),
					'required'  => array('sticky_header_submenu_color_type', '=', 'custom'),
					'mode'          => 'background',
					'transparent'   => false
				),


				array(
					'id'            => 'sticky_geritcht_header_submenu_hover_color',
					'type'          => 'color',
					'desc'     => esc_html__('Submenu Hover Color', 'geritcht'),
					'required'  => array('sticky_header_submenu_color_type', '=', 'custom'),
					'mode'          => 'background',
					'transparent'   => false
				),

				array(
					'id'            => 'sticky_geritcht_header_submenu_background_color',
					'type'          => 'color',
					'desc'     => esc_html__('Submenu Background Color', 'geritcht'),
					'required'  => array('sticky_header_submenu_color_type', '=', 'custom'),
					'mode'          => 'background',
					'transparent'   => false
				),

				array(
					'id'            => 'sticky_header_submenu_background_hover_color',
					'type'          => 'color',
					'desc'     => esc_html__('Submenu Background Hover Color', 'geritcht'),
					'required'  => array('sticky_header_submenu_color_type', '=', 'custom'),
					'mode'          => 'background',
					'transparent'   => false
				),
				// --------sticky header Menu options start----------//sss
			)
		));
	}
}
