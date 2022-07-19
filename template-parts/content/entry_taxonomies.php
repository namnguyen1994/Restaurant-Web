<?php

/**
 * Template part for displaying a post's taxonomy terms
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht;

$taxonomies = wp_list_filter(
	get_object_taxonomies($post, 'objects'),
	array(
		'public' => true,
	)
);

?>
<ul class="geritcht-blogtag">
	<li class="geritcht-comment-count">
		<?php
		$comments_number = get_comments_number();
		echo esc_html($comments_number);
		if ($comments_number == 1) {
			_e(' Comment', 'geritcht');
		} else {
			_e(' Comments', 'geritcht');
		}
		?>
	</li>
	<?php
	$post_tag = get_the_tags();
	if ($post_tag) { ?>

		<?php foreach ($post_tag as $cat) { ?>
			<li><a href="<?php get_category_link($cat->cat_ID) ?>"><?php echo esc_html($cat->name); ?></a></li>
		<?php } ?>
	<?php }
	?>
</ul>