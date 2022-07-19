<?php
/**
 * Geritcht\Geritcht\Dynamic_Style\Styles\Logo class
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht\Dynamic_Style\Styles;

use Geritcht\Geritcht\Dynamic_Style\Component;
use function add_action;

class Logo extends Component
{

	public function __construct()
	{
		add_action('wp_enqueue_scripts', array($this, 'geritcht_logo_options'), 20);
	}

	public function geritcht_logo_options(){
        $geritcht_options = get_option('geritcht-options');
        $logo_var = '';
        if(isset($geritcht_options['header_radio']) && $geritcht_options['header_radio'] == 1){
            if(isset($geritcht_options['header_color'])){
                $logo = $geritcht_options['header_color'];
                    $logo_var .= "
                    .navbar-light .navbar-brand {
                        color : $logo !important;
                    }"; 
            }  
        }          
            wp_add_inline_style( 'geritcht-global', $logo_var );
    }
}
