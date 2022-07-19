<?php
/**
 * Geritcht\Geritcht\Dynamic_Style\Styles\Loader class
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht\Dynamic_Style\Styles;

use Geritcht\Geritcht\Dynamic_Style\Component;
use function add_action;

class Loader extends Component
{

	public function __construct()
	{
		add_action('wp_enqueue_scripts', array($this, 'geritcht_loader_options'), 20);
	}

	public function geritcht_loader_options(){
        $geritcht_options = get_option('geritcht-options');
        $loader_css = '';
            if(isset($geritcht_options['loader_bg_color'])){
                $loader_var = $geritcht_options['loader_bg_color'];
                if( !empty($loader_var) && $loader_var != '#ffffff') {
                    $loader_css .= "
                    #loading {
                        background : $loader_var !important;
                    }"; 
                }
            }            
            wp_add_inline_style( 'geritcht-global', $loader_css );
    }
}
