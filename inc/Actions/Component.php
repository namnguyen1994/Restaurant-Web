<?php

/**
 * Geritcht\Geritcht\Actions\Component class
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht\Actions;

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
		return 'actions';
	}
	public function initialize() {
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
			'geritcht_get_blog_readmore_link' => array($this, 'geritcht_get_blog_readmore_link'),
			'geritcht_get_blog_readmore' => array($this, 'geritcht_get_blog_readmore'),
			'geritcht_get_comment_btn' => array($this, 'geritcht_get_comment_btn'),
			'geritcht_get_comment_reply' => array($this, 'geritcht_get_comment_reply'),
		);
	}

	//** Blog Read More Button Link **//
	public function geritcht_get_blog_readmore_link()
	{
		echo '<div class="blog-button">		
				<a class="geritcht-button geritcht-button-link" href="' . get_the_permalink() . '">' . __('Read More', 'geritcht') . ' 
					
				</a>
			</div>';
	}


	//** Blog Read More Button **//
	public function geritcht_get_blog_readmore($link,$btn_text)
	{
		echo '<div class="blog-button">		
				<a class="geritcht-button" href="' . esc_url($link) . '">' .esc_html($btn_text) . ' 
					
				</a>
			</div>';
	}


	//** Comment Submit Button **//
	public function geritcht_get_comment_btn()
	{
		return '<button name="submit" type="submit" id="submit" class="submit geritcht-button" value="' . __('Post Comment' . 'geritcht') . '" >
					<span class="geritcht-main-btn">
						<span class="text-btn">' . esc_html__('Post Comment', 'geritcht') . '</span>
					</span>
				</button>';
	}

	//** Comment Reply Button **//
	public function geritcht_get_comment_reply($depth)
	{
		if ($depth < get_option('thread_comments_depth') && comments_open()) { ?>
			<div class="reply geritcht-reply geritcht-button-style-2">
				<a rel="nofollow" class="comment-reply-link geritcht-button geritcht-button-link" href="<?php get_comment_author_link(); ?>?replytocom=<?php comment_ID(); ?>#respond" data-commentid="<?php comment_ID(); ?>" data-postid="<?php the_ID(); ?>" data-belowelement="div-comment-<?php comment_ID(); ?>" data-respondelement="respond" data-replyto="Reply to admin" aria-label="Reply to admin">
					<?php echo __('Reply', 'geritcht'); ?>
				</a>
			</div>
<?php }
	}
}

