<?php

/**
 * Template part for displaying the Breadcrumb 
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht;

if (is_front_page()) {
        if (is_home()) { ?>
            <div class="geritcht-breadcrumb-one text-center green-bg">
                <div class="container">
                    <div class="row flex-row-reverse">
                        <div class="col-sm-12">
                            <div class="heading-title white geritcht-breadcrumb-title">
                                <h1 class="title"><?php esc_html_e('Home', 'geritcht'); ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php }
}
geritcht()->geritcht_inner_breadcrumb();
?>