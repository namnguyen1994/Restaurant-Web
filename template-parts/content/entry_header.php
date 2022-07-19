<?php
/**
 * Template part for displaying a post's header
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht;
$geritcht_options = get_option('geritcht-options');
?>


	<?php
	if ( ! is_search() ) {
		if(isset($geritcht_options['display_featured_image']))
		{
		$options = $geritcht_options['display_featured_image'];
		if($options == "yes"){
				get_template_part( 'template-parts/content/entry_thumbnail', get_post_type() );
			} 
		}
		else{
			get_template_part( 'template-parts/content/entry_thumbnail', get_post_type() );
		}
	} ?>
	<div class="geritcht-blog-detail">
	<?php 
	get_template_part('template-parts/content/entry_meta', get_post_type());
	if( ! is_single() ) {
	get_template_part( 'template-parts/content/entry_title', get_post_type() );
	}
	?>
<!-- .entry-header -->
