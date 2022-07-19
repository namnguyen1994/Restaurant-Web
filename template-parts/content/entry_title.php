<?php
/**
 * Template part for displaying a post's title
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht;

if ( is_singular( get_post_type() ) ) {
	
} else {
	echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><h3 class="entry-title">'.get_the_title().'</h3></a>';
}
