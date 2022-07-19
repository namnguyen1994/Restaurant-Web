<?php
/**
 * Template part for displaying a post's content
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht;

?>

	<?php
	if (is_single()) {
		the_content();
	} else {
		the_excerpt();
	}

	if (is_single()) { 
		$post_slug = ''; ?>
		<?php
			$post_tag = get_the_tags();
			if ($post_tag) { ?>
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
	</li> <?php 
					foreach ($post_tag as $cat) { ?>
						<li><a href="<?php get_category_link($cat->cat_ID) ?>"><?php echo esc_html($cat->name); ?></a></li> <?php 
					} ?>
			</ul> 
		<?php } 
		if(class_exists('ReduxFramework')) {
			$data['request_scheme'] = esc_html($GLOBALS['_SERVER']['REQUEST_SCHEME']);
			$data['http_host'] = esc_html($GLOBALS['_SERVER']['HTTP_HOST']);
			$data['request_url'] = esc_html($GLOBALS['_SERVER']['REQUEST_URI']);
			$postUrl = 'http' . ( $data['request_scheme'] == "http" ? '' : 's' ) . '://' . "{$data['http_host']}{$data['request_url']}";
			$geritcht_options = get_option('geritcht-options'); ?>
			<div class="shared-icons position-relative">			
				<div class="social-box">
					<ul class="list-unstyled"> <?php				
						if(isset($geritcht_options['facebook_onoff']) && $geritcht_options['facebook_onoff'] == '1' ) { ?>
							<li class="label"><?php esc_html_e('share :','geritcht') ?></li>
							<li>
								<a target="_blank" class="share-button share-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_html($postUrl); ?>" title="Share on Facebook">
								    <i class="fab fa-facebook" aria-hidden="true"></i>
								</a>
							</li> <?php
						}
						if(isset($geritcht_options['twitter_onoff']) && $geritcht_options['twitter_onoff'] == '1' ) { ?>
							<li>
							    <a target="_blank" class="share-button share-twitter" href="https://twitter.com/intent/tweet?url=<?php echo esc_html($postUrl); ?>&text=<?php echo esc_html($post_slug); ?>&via=<?php the_author_meta( 'twitter' ); ?>" title="Tweet this">
								    <i class="fab fa-twitter-square" aria-hidden="true"></i> 
							    </a>
							</li> <?php
						} ?>
					</ul>
				</div>
			</div> <?php 
		}

	} ?>

</div><!-- .entry-content -->
