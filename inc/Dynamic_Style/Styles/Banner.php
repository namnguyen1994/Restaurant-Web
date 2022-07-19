<?php

/**
 * Geritcht\Geritcht\Dynamic_Style\Styles\Banner class
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht\Dynamic_Style\Styles;

use Geritcht\Geritcht\Dynamic_Style\Component;
use function add_action;

class Banner extends Component
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'geritcht_banner_dynamic_style'), 20);
        add_action('wp_enqueue_scripts', array($this, 'geritcht_opacity_color'), 20);
        add_action('wp_enqueue_scripts', array($this, 'geritcht_banner_hide'), 20);
    }

    public function geritcht_banner_dynamic_style()
    {
        $page_id = get_queried_object_id();
        $geritcht_options = get_option('geritcht-options');
        $dynamic_css = '';

        if (isset($geritcht_options['display_banner'])) {
            if ($geritcht_options['display_banner'] == 'no') {
                $dynamic_css .=
                    '.geritcht-breadcrumb-one { display: none !important; }
                    .content-area .site-main {padding : 0 !important; }';
            }
        }

        if (isset($geritcht_options['display_title'])) {

            if ($geritcht_options['display_title'] == 'no') {
                $dynamic_css .=
                    '.geritcht-breadcrumb-one .title { display: none !important; }';
            }
        }

        if (isset($geritcht_options['display_breadcumb'])) {

            if ($geritcht_options['display_breadcumb'] == 'no') {
                $dynamic_css .=
                    '.geritcht-breadcrumb-one .breadcrumb { display: none !important; }';
            }
        }

        if (isset($geritcht_options['bg_title_color'])) {

            if ($geritcht_options['bg_title_color'] == 'yes') {
                $dynamic = $geritcht_options['bg_title_color'];
                $dynamic_css .=
                    '.geritcht-breadcrumb-one .title { color: ' . $dynamic . ' !important; }';
            }
        }
        if (isset($geritcht_options['bg_type'])) {
            $opt = $geritcht_options['bg_type'];
            if ($opt == '1') {
                if (isset($geritcht_options['bg_color']) && !empty($geritcht_options['bg_color'])) {
                    $dynamic = $geritcht_options['bg_color'];
                    $dynamic_css .=
                        '.geritcht-breadcrumb-one { background: ' . $dynamic . ' !important; }';
                }
            }
            if ($opt == '2') {
                if (isset($geritcht_options['banner_image']['url'])) {
                    $dynamic = $geritcht_options['banner_image']['url'];
                    $dynamic_css .=
                        '.geritcht-breadcrumb-one { background-image: url(' . $dynamic . ') !important; }';
                }
            }
        }

        wp_add_inline_style('geritcht-global', $dynamic_css);
    }
    public function geritcht_opacity_color()
    {
        //Set Background Opacity Color
        $geritcht_options = get_option('geritcht-options');

        if (!empty($geritcht_options['bg_opacity']) && $geritcht_options['bg_opacity'] == "3") {
            $bg_opacity = $geritcht_options['opacity_color']['rgba'];
        }
        $dynamic_css = '';

        if (!empty($geritcht_options['bg_opacity']) && $geritcht_options['bg_opacity'] == "3") {
            if (!empty($bg_opacity) && $bg_opacity != '#ffffff') {
                $dynamic_css .= "
            .breadcrumb-video::before,.breadcrumb-bg::before, .breadcrumb-ui::before {
                background : $bg_opacity !important;
            }";
            }
        }
        wp_add_inline_style('geritcht-global', $dynamic_css);
    }

    public function geritcht_banner_hide()
    { 
        $geritcht_options = get_option('geritcht-options');
        $banner_hide = '';
        $pages = '';
        if(isset($geritcht_options['pages_select'])){
            $pages = $geritcht_options['pages_select'];
            foreach($pages as $data){

                $page = get_page_by_path( $data );
                if(isset($page)){
                    $banner_hide .= '.page-id-'.$page->ID.' .geritcht-breadcrumb-one { display: none !important; }';
                }
    
            }
        }

        wp_add_inline_style('geritcht-global', $banner_hide);
    }

}
