<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht;

$geritcht_options = get_option('geritcht-options');
$is_sidebar = geritcht()->is_primary_sidebar_active();
$post_section = geritcht()->post_style();
get_header();
$geritcht_layout = '';
if (isset($geritcht_options['blog_setting'])) {
	$geritcht_layout = $geritcht_options['blog_setting'];
}
?>
<div class="site-content-contain">
	<div id="content" class="site-content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<div class="container">
					<div class="row <?php echo esc_attr($post_section['row_reverse']); ?>">
						<?php if ($is_sidebar) {
							echo '<div class="col-xl-8 col-sm-12 geritcht-blog-main-list">';
						} else if ($geritcht_layout != '2' && $geritcht_layout != '3') {
							echo '<div class="col-lg-12 col-sm-12 geritcht-blog-main-list">';
						}
						if (have_posts()) {

							while (have_posts()) { ?>
								<?php the_post();
								get_template_part('template-parts/content/entry', get_post_type(), $post_section['post']);
								?>
						<?php }

							if (!is_singular()) {
								if (isset($geritcht_options['display_pagination'])) {
									$options = $geritcht_options['display_pagination'];
									if ($options == "yes") {
										get_template_part('template-parts/content/pagination');
									}
								} else {
									get_template_part('template-parts/content/pagination');
								}
							}
						} else {
							get_template_part('template-parts/content/error');
						}
						?>
						<?php if ($is_sidebar || $geritcht_layout != '2' && $geritcht_layout != '3') {
							echo '</div>';
						}
						get_sidebar(); ?>
					</div>
				</div>
			</main><!-- #primary -->
		</div>
	</div>
</div>
<?php
get_footer();
