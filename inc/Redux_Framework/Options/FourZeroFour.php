<?php
/**
 * Geritcht\Geritcht\Redux_Framework\Options\FourZeroFour class
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht\Redux_Framework\Options;

use Redux;
use Geritcht\Geritcht\Redux_Framework\Component;

class FourZeroFour extends Component
{

	public function __construct()
	{
		$this->set_widget_option();
	}

	protected function set_widget_option()
	{
		Redux::set_section( $this->opt_name, array(
			'title' => esc_html__('404','geritcht'),
			'id'    => 'fourzerofour',
			'icon'  => 'el-icon-error',
			'desc'  => esc_html__('This section contains options for 404.','geritcht'),
			'fields'=> array(

				array(
					'id'       => '404_banner_image',
					'type'     => 'media',
					'url'      => true,
					'title'    => esc_html__( '404 Page Default Banner Image','geritcht'),
					'read-only'=> false,
					'default'  => array( 'url' => get_template_directory_uri() .'/assets/images/redux/404.png' ),
					'subtitle' => esc_html__( 'Upload banner image for your Website. Otherwise blank field will be displayed in place of this section.','geritcht'),
				),

				array(
					'id'        => '404_title',
					'type'      => 'text',
					'title'     => esc_html__( '404 Page Title','geritcht'),
					'default'   => esc_html__( 'Oops! This Page is Not Found.','geritcht' )
				),
				array(
					'id'        => '404_description',
					'type'      => 'textarea',
					'title'     => esc_html__( '404 Page Description','geritcht'),
					'default'   => esc_html__( 'The requested page does not exist.','geritcht' )
				),
			)));
	}

}
