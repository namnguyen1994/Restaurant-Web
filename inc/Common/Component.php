<?php

/**
 * Geritcht\Geritcht\Comments\Component class
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht\Common;

use Geritcht\Geritcht\Component_Interface;
use Geritcht\Geritcht\Templating_Component_Interface;
use function add_action;

/**
 * Class for managing comments UI.
 *
 * Exposes template tags:
 * * `geritcht()->the_comments( array $args = array() )`
 *
 * @link https://wordpress.org/plugins/amp/
 */
class Component implements Component_Interface, Templating_Component_Interface
{
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string
	{
		return 'common';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize()
	{
		add_filter('widget_tag_cloud_args', array($this, 'geritcht_widget_tag_cloud_args'), 100);
		add_filter('wp_list_categories', array($this, 'geritcht_categories_postcount_filter'), 100);
		add_filter('get_archives_link', array($this, 'geritcht_style_the_archive_count'), 100);
		add_filter('upload_mimes', array($this, 'geritcht_mime_types'), 100);
		add_action('wp_enqueue_scripts', array($this, 'geritcht_remove_wp_block_library_css'), 100);
		add_action('wp_enqueue_scripts', array($this, 'geritcht_remove_wp_block_library_css'), 100);
		add_action('wp_enqueue_scripts', array($this, 'geritcht_remove_wp_block_library_css'), 100);
		add_filter('pre_get_posts', array($this, 'geritcht_searchfilter'), 100);
		add_theme_support('post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		));
	}

	public function __construct()
	{
		add_filter('the_content', array($this, 'geritcht_remove_empty_p'));
		add_filter('get_the_content', array($this, 'geritcht_remove_empty_p'));
		add_filter('get_the_excerpt', array($this, 'geritcht_remove_empty_p'));
		add_filter('the_excerpt', array($this, 'geritcht_remove_empty_p'));
	}

	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `geritcht()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs. Each $callback_info must either be
	 *               a callable or an array with key 'callable'. This approach is used to reserve the possibility of
	 *               adding support for further arguments in the future.
	 */
	public function template_tags(): array
	{
		return array(
			'geritcht_pagination' => array($this, 'geritcht_pagination'),
			'geritcht_inner_breadcrumb' => array($this, 'geritcht_inner_breadcrumb'),
			'geritcht_get_embed_video' => array($this, 'geritcht_get_embed_video'),
		);
	}


	function geritcht_get_embed_video($post_id)
	{
		$post = get_post($post_id);
		$content = do_shortcode(apply_filters('the_content', $post->post_content));
		$embeds = get_media_embedded_in_content($content);
		if (!empty($embeds)) {
			foreach ($embeds as $embed) {
				if (strpos($embed, 'video') || strpos($embed, 'youtube') || strpos($embed, 'vimeo') || strpos($embed, 'dailymotion') || strpos($embed, 'vine') || strpos($embed, 'wordPress.tv') || strpos($embed, 'embed') || strpos($embed, 'audio') || strpos($embed, 'iframe') || strpos($embed, 'object')) {
					return $embed;
				}
			}
		} else {
			return;
		}
	}

	function geritcht_remove_empty_p($string)
	{
		return preg_replace('/<p>(?:\s|&nbsp;)*?<\/p>/i', '', $string);
	}

	function geritcht_remove_wp_block_library_css()
	{
		wp_dequeue_style('wp-block-library-theme');
	}

	public function geritcht_widget_tag_cloud_args($args)
	{
		$args['largest'] = 1;
		$args['smallest'] = 1;
		$args['unit'] = 'em';
		$args['format'] = 'list';

		return $args;
	}
	function geritcht_mime_types($mimes)
	{
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
	function geritcht_categories_postcount_filter($variable)
	{
		$variable = str_replace('(', '<span class="archiveCount"> (', $variable);
		$variable = str_replace(')', ') </span>', $variable);
		return $variable;
	}

	function geritcht_style_the_archive_count($links)
	{
		$links = str_replace('</a>&nbsp;(', '</a> <span class="achiveCount"> (', $links);
		$links = str_replace('&nbsp;)</li>', ' </li></span>', $links);
		return $links;
	}

	public function geritcht_pagination($numpages = '', $pagerange = '', $paged = '')
	{

		if (empty($pagerange)) {
			$pagerange = 2;
		}
		global $paged;
		if (empty($paged)) {
			$paged = 1;
		}
		if ($numpages == '') {
			global $wp_query;
			$numpages = $wp_query->max_num_pages;
			if (!$numpages) {
				$numpages = 1;
			}
		}
		/**
		 * We construct the pagination arguments to enter into our paginate_links
		 * function.
		 */
		$pagination_args = array(
			'format' => '?paged=%#%',
			'total' => $numpages,
			'current' => $paged,
			'show_all' => false,
			'end_size' => 1,
			'mid_size' => $pagerange,
			'prev_next' => true,
			'prev_text'       => '<i class="fas fa-chevron-left"></i>',
			'next_text'       => '<i class="fas fa-chevron-right"></i>',
			'type' => 'list',
			'add_args' => false,
			'add_fragment' => ''
		);

		$paginate_links = paginate_links($pagination_args);
		if ($paginate_links) {
			echo '<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="pagination justify-content-center">
								<nav aria-label="Page navigation">';
			printf(esc_html__('%s', 'geritcht'), $paginate_links);
			echo '</nav>
					</div>
				</div>';
		}
	}

	public function geritcht_inner_breadcrumb()
	{
		$geritcht_option = get_option('geritcht-options');
		if (!is_front_page() && !is_404()) {

			if (is_page() && has_post_thumbnail(get_queried_object_id())) {
				$options = '';

				if (isset($geritcht_option['bg_opacity'])) {
					$options = $geritcht_option['bg_opacity'];
				}

				if ($options == "1") {
					$bg_class = 'geritcht-bg-over black';
				} elseif ($options == "2") {
					$bg_class = 'geritcht-bg-over geritcht-over-dark-80';
				} elseif ($options == "3") {
					$bg_class = 'breadcrumb-bg breadcrumb-ui';
				} else {
					$bg_class = 'geritcht-bg-over geritcht-over-dark-80';
				}
?>
				<div class="text-left geritcht-breadcrumb-one <?php if (!empty($bg_class)) {
																	echo esc_attr($bg_class);
																} ?>">
				<?php

			} else {

				if (!empty($geritcht_option['bg_type']) && $geritcht_option['bg_type'] == "1") {

					$bg_color = esc_html__('geritcht-bg-over black', 'geritcht');
				} elseif (!empty($geritcht_option['bg_type']) && $geritcht_option['bg_type'] == "2") {

					if (isset($geritcht_option['banner_image']['url'])) {
						$bgurl = $geritcht_option['banner_image']['url'];
					}
					$options = $geritcht_option['bg_opacity'];

					if ($options == "1") {
					} elseif ($options == "2") {
						$bg_class = 'geritcht-bg-over geritcht-over-dark-80';
					} elseif ($options == "3") {
						$bg_class = 'breadcrumb-bg breadcrumb-ui';
					} else {
						$bg_class = 'geritcht-bg-over geritcht-over-dark-80';
					}
				} else {
					$bg_class = 'geritcht-bg-over';
				} ?>

					<div class="geritcht-breadcrumb-one <?php if (isset($geritcht_option['bg_type']) && !empty($geritcht_option['bg_type'] == "1")) {
																echo esc_attr($bg_color);
															} ?> <?php if (!empty($bg_class)) {
																		echo esc_attr($bg_class);
																	} ?>"> <?php
																		} ?>

					<div class="container">
						<?php

						$options = '';

						if (!empty($geritcht_option['bg_image'])) {
							$options = $geritcht_option['bg_image'];
						}

						if ($options == '1' && class_exists('ReduxFramework')) {    ?>
							<div class="row align-items-center justify-content-center text-center">
								<div class="col-sm-12">
									<nav aria-label="breadcrumb" class=" geritcht-breadcrumb-two">
										<?php
										$this->geritcht_breadcrumbs_title();
										if (isset($geritcht_option['display_breadcrumbs'])) {
											$options = $geritcht_option['display_breadcrumbs'];
											if ($options == "yes") {
										?>
												<ol class="breadcrumb main-bg">
													<?php $this->geritcht_custom_breadcrumbs(); ?>
												</ol>
										<?php
											}
										}
										
										?>
									</nav>

								</div>
							</div>
						<?php

						} elseif ($options == '2' && class_exists('ReduxFramework')) { ?>

							<div class="row align-items-center">
								<div class="col-lg-8 col-md-8 text-left align-self-center">
									<nav aria-label="breadcrumb" class="text-left">
										<?php

										if (isset($geritcht_option['display_breadcrumbs'])) {
											$options = $geritcht_option['display_breadcrumbs'];
											if ($options == "yes") { ?>
												<ol class="breadcrumb main-bg">
													<?php $this->geritcht_custom_breadcrumbs(); ?>
												</ol> <?php
													}
												}
												$this->geritcht_breadcrumbs_title(); ?>
									</nav>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-12 text-right wow fadeInRight">
									<?php $this->geritcht_breadcrumbs_feature_image(); ?>
								</div>
							</div>
						<?php

						} elseif ($options == '3' && class_exists('ReduxFramework')) { ?>

							<div class="row align-items-center">
								<div class="col-lg-4 col-md-4 col-sm-12 wow fadeInLeft">
									<?php $this->geritcht_breadcrumbs_feature_image(); ?>
								</div>
								<div class="col-lg-8 col-md-8 text-left align-self-center">
									<nav aria-label="breadcrumb" class="text-right geritcht-breadcrumb-two">
										<?php
										$this->geritcht_breadcrumbs_title();
										if (isset($geritcht_option['display_breadcrumbs'])) {
											$options = $geritcht_option['display_breadcrumbs'];
											if ($options == "yes") { ?>
												<ol class="breadcrumb main-bg">
													<?php $this->geritcht_custom_breadcrumbs(); ?>
												</ol> <?php
													}
												}
												 ?>
									</nav>
								</div>
							</div>
						<?php

						} elseif ($options == '4' && class_exists('ReduxFramework')) { ?>

							<div class="row align-items-center geritcht-breadcrumb-three">
								<div class="col-sm-6 mb-3 mb-lg-0 mb-md-0">
									<?php $this->geritcht_breadcrumbs_title(); ?>
								</div>
								<div class="col-sm-6 ext-lg-right text-md-right text-sm-left">
									<nav aria-label="breadcrumb" class="geritcht-breadcrumb-two">
										<?php
										if (isset($geritcht_option['display_breadcrumbs'])) {
											$options = $geritcht_option['display_breadcrumbs'];
											if ($options == "yes") { ?>
												<ol class="breadcrumb main-bg">
													<?php $this->geritcht_custom_breadcrumbs(); ?>
												</ol> <?php
													}
												} ?>
									</nav>
								</div>
							</div>
						<?php

						} elseif ($options == '5' && class_exists('ReduxFramework')) { ?>

							<div class="row align-items-center geritcht-breadcrumb-three">
								<div class="col-sm-6 mb-3 mb-lg-0 mb-md-0">
									<nav aria-label="breadcrumb" class="text-left geritcht-breadcrumb-two">
										<?php
										if (isset($geritcht_option['display_breadcrumbs'])) {
											$options = $geritcht_option['display_breadcrumbs'];
											if ($options == "yes") {
										?>
												<ol class="breadcrumb main-bg">
													<?php $this->geritcht_custom_breadcrumbs(); ?>
												</ol>
										<?php
											}
										}
										?>
									</nav>
								</div>
								<div class="col-sm-6 text-right">
									<?php $this->geritcht_breadcrumbs_title(); ?>
								</div>
							</div>
						<?php

						} else { ?>
							<div class="row align-items-center">
								<div class="col-sm-12">
									<nav aria-label="breadcrumb" class="text-center">
										<ol class="breadcrumb main-bg">
											<?php $this->geritcht_custom_breadcrumbs(); ?>
										</ol>
										<?php $this->geritcht_breadcrumbs_title(); ?>
									</nav>
								</div>
							</div> <?php

								} ?>

					</div>
					</div>
				<?php
			}
		}

		function geritcht_breadcrumbs_title()
		{

			$geritcht_options = get_option('geritcht-options');
			$title_tag = 'h2';
			$title = '';
			if (isset($geritcht_options['breadcum_title_tag'])) {
				$title_tag = $geritcht_options['breadcum_title_tag'];
			}

			if (is_archive()) {
				$title = get_the_archive_title();
			} elseif (is_search()) {
				if (have_posts()) :
					$title = esc_html__('Search Results for:', 'geritcht');
					$title = $title . ' <span>' . get_search_query() . '</span>';
				else : $title = __('Nothing Found', 'geritcht');
				endif;
			} elseif (is_404()) {
				if (isset($geritcht_options['geritcht_fourzerofour_title'])) {
					$title = $geritcht_options['geritcht_fourzerofour_title'];
				} else {
					$title = __('Oops! That page can not be found.', 'geritcht');
				}
			} elseif (is_home()) {
				$title = wp_title('', false);
			} else {
				$title = get_the_title();
			}
				?>
				<<?php echo esc_attr($title_tag); ?> class="title">
					<?php echo wp_kses_post($title); ?>
				</<?php echo esc_attr($title_tag); ?>>
				<?php
			}

			function geritcht_breadcrumbs_feature_image()
			{

				$geritcht_options = get_option('geritcht-options');
				$bnurl = '';
				$page_id = get_queried_object_id();
				if (has_post_thumbnail($page_id) && !is_single()) {
					$image_array = wp_get_attachment_image_src(get_post_thumbnail_id($page_id), 'full');
					$bnurl = $image_array[0];
				} elseif (is_404()) {
					if (!empty($geritcht_options['404_banner_image']['url'])) {
						$bnurl = $geritcht_options['404_banner_image']['url'];
					}
				} elseif (is_home()) {
					if (!empty($geritcht_options['blog_default_banner_image']['url'])) {
						$bnurl = $geritcht_options['blog_default_banner_image']['url'];
					}
				} else {
					if (!empty($geritcht_options['page_default_banner_image']['url'])) {
						$bnurl = $geritcht_options['page_default_banner_image']['url'];
					}
				}

				if (!empty($bnurl)) {
				?>
					<img src="<?php echo esc_url($bnurl); ?>" class="img-fluid <?php if (!empty($geritcht_option['bg_image'])) {
																					if (!$geritcht_option['bg_image'] == 1) {
																						echo 'float-right';
																					}
																				} ?>" alt="<?php esc_attr_e('banner', 'geritcht'); ?>">
				<?php
				}
			}
			function geritcht_custom_breadcrumbs()
			{

				$show_on_home = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
				$home = '' . esc_html__('Home', 'geritcht') . ''; // text for the 'Home' link
				$show_current = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show

				global $post;
				$home_link = esc_url(home_url());

				if (is_front_page()) {

					if ($show_on_home == 1) echo '<li class="breadcrumb-item"><a href="' . $home_link . '">' . $home . '</a></li>';
				} else {

					echo '<li class="breadcrumb-item"><a href="' . $home_link . '">' . $home . '</a></li> ';

					if (is_home()) {
						echo  '<li class="breadcrumb-item active">' . esc_html__('Blogs', 'geritcht') . '</li>';
					} elseif (is_category()) {
						$this_cat = get_category(get_query_var('cat'), false);
						if ($this_cat->parent != 0) echo '<li class="breadcrumb-item">' . get_category_parents($this_cat->parent, TRUE, '  ') . '</li>';
						echo  '<li class="breadcrumb-item active">' . esc_html__('Archive by category : ', 'geritcht') . ' "' . single_cat_title('', false) . '" </li>';
					} elseif (is_search()) {
						echo  '<li class="breadcrumb-item active">' . esc_html__('Search results for : ', 'geritcht') . ' "' . get_search_query() . '"</li>';
					} elseif (is_day()) {
						echo '<li class="breadcrumb-item"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ';
						echo '<li class="breadcrumb-item"><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li>  ';
						echo  '<li class="breadcrumb-item active">' . get_the_time('d') . '</li>';
					} elseif (is_month()) {
						echo '<li class="breadcrumb-item"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ';
						echo  '<li class="breadcrumb-item active">' . get_the_time('F') . '</li>';
					} elseif (is_year()) {
						echo  '<li class="breadcrumb-item active">' . get_the_time('Y') . '</li>';
					} elseif (is_single() && !is_attachment()) {
						if (get_post_type() != 'post') {
							$post_type = get_post_type_object(get_post_type());
							$slug = $post_type->rewrite;
							if (!empty($slug)) {
								echo '<li class="breadcrumb-item"><a href="' . $home_link . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li>';
							}
							if ($show_current == 1) echo '<li class="breadcrumb-item">' . get_the_title() . '</li>';
						} else {
							$cat = get_the_category();
							if (!empty($cat)) {
								$cat = $cat[0];

								if ($show_current == 0) $cat = preg_replace("#^(.+)\s\s$#", "$1", $cat);
								echo '<li class="breadcrumb-item">' . get_category_parents($cat, TRUE, '  ') . '</li>';
								if ($show_current == 1) echo  '<li class="breadcrumb-item active">' . get_the_title() . '</li>';
							}
						}
					} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
						$post_type = get_post_type_object(get_post_type());
						echo  '<li class="breadcrumb-item active">' . $post_type->labels->singular_name . '</li>';
					} elseif (!is_single() && is_attachment()) {
						$parent = get_post($post->post_parent);
						$cat = get_the_category($parent->ID);
						$cat = $cat[0];
						echo '<li class="breadcrumb-item">' . get_category_parents($cat, TRUE, '  ') . '</li>';
						echo '<li class="breadcrumb-item"><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
						if ($show_current == 1) echo '<li class="breadcrumb-item active"> ' .  get_the_title() . '</li>';
					} elseif (is_page() && !$post->post_parent) {
						if ($show_current == 1) echo  '<li class="breadcrumb-item active">' . get_the_title() . '</li>';
					} elseif (is_page() && $post->post_parent) {
						$trail = '';
						// $page_title = '<li class="breadcrumb-item">' . get_the_title($post->ID) . '</li>';
						if ($post->post_parent) {
							$parent_id = $post->post_parent;
							$breadcrumbs = array();
							while ($parent_id) {
								$page = get_post($parent_id);
								$breadcrumbs[] = '<li class="breadcrumb-item"><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
								$parent_id  = $page->post_parent;
							}
							$breadcrumbs = array_reverse($breadcrumbs);
							foreach ($breadcrumbs as $crumb) $trail .= $crumb;
						}

						echo wp_kses_post($trail);
						if ($show_current == 1) echo '<li class="breadcrumb-item active"> ' .  get_the_title() . '</li>';
					} elseif (is_tag()) {
						echo  '<li class="breadcrumb-item active">' . esc_html__('Posts tagged', 'geritcht') . ' "' . single_tag_title('', false) . '"</li>';
					} elseif (is_author()) {
						global $author;
						$userdata = get_userdata($author);
						echo  '<li class="breadcrumb-item active">' . esc_html__('Articles posted by : ', 'geritcht') . ' ' . $userdata->display_name . '</li>';
					} elseif (is_404()) {
						echo  '<li class="breadcrumb-item active">' . esc_html__('Error 404', 'geritcht') . '</li>';
					}

					if (get_query_var('paged')) {
						echo '<li class="breadcrumb-item active">' . esc_html__('Page', 'geritcht') . ' ' . get_query_var('paged') . '</li>';
					}
				}
			}


			function geritcht_searchfilter($query)
			{
				if (!is_admin()) {
					if ($query->is_search) {
						$query->set('post_type', 'post');
					}
					return $query;
				}
			}
		}
