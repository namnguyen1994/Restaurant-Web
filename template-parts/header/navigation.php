<?php

/**
 * Template part for displaying the header navigation menu
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht;

$geritcht_options = get_option('geritcht-options');
?>

<nav id="site-navigation" class="navbar deafult-header navbar-expand-xl navbar-light p-0" aria-label="<?php esc_attr_e('Main menu', 'geritcht'); ?>" <?php
																																					if (geritcht()->is_amp()) {
																																					?> [class]=" siteNavigationMenu.expanded ? 'main-navigation nav--toggle-sub nav--toggle-small nav--toggled-on' : 'main-navigation nav--toggle-sub nav--toggle-small' " <?php
																																																																														}
																																																																															?>>

	<a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
		<?php
		if (class_exists('ReduxFramework')) {
			$geritcht_options = get_option('geritcht-options');
		
			if (isset($geritcht_options['header_radio'])) {
				if ($geritcht_options['header_radio'] == 1) {
					$logo_text = $geritcht_options['header_text'];
					echo esc_html($logo_text);
				}
				if ($geritcht_options['header_radio'] == 2) {
					$options = $geritcht_options['geritcht_logo']['url'];
				}
			}
			if (isset($options) && !empty($options)) {
		?>
				<img class="img-fluid logo" src="<?php echo esc_url($options); ?>" alt="<?php esc_attr_e('geritcht', 'geritcht'); ?>">
			<?php
			}
		} elseif (has_header_image()) {
			$image = wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full');
			if (has_custom_logo()) { ?>
				<img class="img-fluid logo" src="<?php echo esc_url($image); ?>" alt="<?php esc_attr_e('geritcht', 'geritcht'); ?>">
			<?php } else { ?>
				<?php bloginfo('name'); ?>
			<?php }
		} else {
			?>
			<img class="img-fluid logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" alt="<?php esc_attr_e('geritcht', 'geritcht'); ?>">
		<?php } ?>
	</a>

	<div id="navbarSupportedContent" class="collapse navbar-collapse new-collapse">
		<div id="geritcht-menu-container" class="menu-all-pages-container">
			<?php
			if (geritcht()->is_primary_nav_menu_active()) {
				geritcht()->display_primary_nav_menu(array(
					'menu_id' => 'top-menu1',
					'menu_class' => 'sf-menu navbar-nav ml-auto',
					'item_spacing' => 'discard'
				));
			}
			?>
		</div>
	</div>
	<div class="geritcht-header-right">
		    <?php 
		if (class_exists('ReduxFramework')) {
			if (isset($geritcht_options['header_display_button']) && $geritcht_options['header_display_button'] == 'yes') { ?>
			    <div class="geritcht-shop-btn-holder">
				    <ul>
					    <li> 
						    <div class="search_count">
							    <a href="javascript:void(0);" id="btn-search"><i class="fa fa-search"></i><span class="search-text ml-2">
								    <?php 
									if (!empty($geritcht_options['header_search_text'])) {
										echo esc_html($geritcht_options['header_search_text']);
									} else {
										echo esc_html__('Search', 'geritcht');
									} ?></span>
								</a>
								<div class="search">
									<button id="btn-search-close" class="btn btn--search-close" aria-label="Close search form">
										<i class="fa fa-times"></i>
									</button>
									<?php get_search_form(); ?>
								</div>
						    </div>
					    </li>
				    </ul>
			    </div>
		      <?php 
			}
		} else{ ?> 

            <div class="geritcht-shop-btn-holder">
				<ul>
					<li>
						<div class="search_count">
							<a href="javascript:void(0);" id="btn-search"><i class="fa fa-search"></i><span class="search-text ml-2">
								<?php echo esc_html__('Search', 'geritcht'); ?></span></a>
								<div class="search">
									<button id="btn-search-close" class="btn btn--search-close" aria-label="Close search form">
										<i class="fa fa-times"></i>
									</button>
									<?php get_search_form(); ?>
								</div>
						    </div>
					    </li>
				    </ul>
			    </div>
				<?php
		}

		if (geritcht()->is_primary_nav_menu_active()) { ?>
			<button class="navbar-toggler custom-toggler ham-toggle" type="button">
				<span class="menu-btn d-inline-block" id="menu-btn">
					<span class="line one"></span>
					<span class="line two"></span>
					<span class="line three"></span>
				</span>
			</button> <?php
		} ?>
	</div>
</nav><!-- #site-navigation -->