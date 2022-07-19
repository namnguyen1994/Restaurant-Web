<?php
function geritcht_import_files()
{
    return array(
        array(
            'import_file_name'             => esc_html__('All Content', 'geritcht'),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit(get_template_directory()) . 'inc/Import/Demo/geritcht_redux.json',
                    'option_name' => 'geritcht-options',
                ),
            ),
            'local_import_file'            => trailingslashit(get_template_directory()) . 'inc/Import/Demo/geritcht-content.xml',
            'local_import_widget_file'     => trailingslashit(get_template_directory()) . 'inc/Import/Demo/geritcht-widget.wie',
            'local_import_customizer_file' => trailingslashit(get_template_directory()) . 'inc/Import/Demo/geritcht-export.dat',

            'import_preview_image_url'     => get_template_directory_uri() . '/inc/Import/Demo/preview_import_image.jpg',
            'import_notice' => esc_html__('DEMO IMPORT REQUIREMENTS: Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds. ', 'geritcht') . '</br></br>' . esc_html__('Based on your INTERNET SPEED it could take 5 to 25 minutes. ', 'geritcht'),
            'preview_url'                  => 'https://wordpress.iqonic.design/product/wp-free/geritcht/',
        ),
    );
}
add_filter('pt-ocdi/import_files', 'geritcht_import_files');

function geritcht_after_import_setup($selected_import)
{

    // Assign menus to their locations.
    $locations = get_theme_mod('nav_menu_locations'); // registered menu locations in theme
    $menus = wp_get_nav_menus(); // registered menus

    if ($menus) {
        foreach ($menus as $menu) { // assign menus to theme locations

            if ($menu->name == 'Main Menu') {
                $locations['primary'] = $menu->term_id;
            }

        }
    }
    set_theme_mod('nav_menu_locations', $locations); // set menus to locations 

    if ('All Content' === $selected_import['import_file_name']) {

        $front_page_id = get_page_by_title('Home 1');
        $blog_page_id  = get_page_by_title('Blog');


        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page_id->ID);
        update_option('page_for_posts', $blog_page_id->ID);
    }
    // remove default post
    wp_delete_post(1, true);
}
add_action('pt-ocdi/after_import', 'geritcht_after_import_setup');

function geritcht_plugin_intro_text($default_text)
{
    $img = get_template_directory_uri() . '/inc/Import/Demo/preview_import_image.jpg';
    $preview_url = 'https://wordpress.iqonic.design/product/wp-free/geritcht/';

    $default_text .= '<div class="ocdi__gl  js-ocdi-gl">
   <div class="ocdi__gl-item-container  wp-clearfix  js-ocdi-gl-item-container">
      <div class="ocdi__gl-item js-ocdi-gl-item" data-categories="" data-name="all content">
         <div class="ocdi__gl-item-image-container">
            <img class="ocdi__gl-item-image" src="' . esc_url($img) . '" alt = "demo">
         </div>
         <div class="ocdi__gl-item-footer  ocdi__gl-item-footer--with-preview">
            <h4 class="ocdi__gl-item-title" title="All Content">All Content</h4>
            
            <a class="ocdi__gl-item-button  button" href="' . esc_url($preview_url) . '" target="_blank">Preview</a>
         </div>
      </div>
     
   </div>
</div>';

    return $default_text;
}
add_filter('pt-ocdi/plugin_intro_text', 'geritcht_plugin_intro_text');
