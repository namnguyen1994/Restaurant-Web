<?php

/**
 * Template part for displaying the footer info
 *
 * @package geritcht
 */

namespace Geritcht\Geritcht;

if (class_exists('ReduxFramework')) {

	$geritcht_options = get_option('geritcht-options');
?>
	<div class="copyright-footer">
		<div class="container">
			<div class="row">
				<?php if (isset($geritcht_options['display_copyright']) && $geritcht_options['display_copyright'] == 'yes') {  ?>
					<div class="col-sm-12 m-0 text-<?php echo esc_attr($geritcht_options['footer_copyright_align']); ?>">
						<div class="pt-3 pb-3">
							<?php
							if (isset($geritcht_options['footer_copyright'])) {  ?>
								<span class="copyright"><?php echo html_entity_decode($geritcht_options['footer_copyright']); ?></span>
							<?php
							} else {	?>
								<span class="copyright"><a target="_blank" href="<?php echo esc_url(__('https://iqonic.design/', 'geritcht')); ?>"> <?php printf(esc_html__('© 2021', 'geritcht'), 'geritcht'); ?><strong><?php printf(esc_html__(' geritcht ', 'geritcht'), 'geritcht'); ?></strong><?php printf(esc_html__('. All Rights Reserved.', 'geritcht'), 'geritcht'); ?></a></span>
							<?php
							} ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div><!-- .site-info -->

<?php } else { ?>

	<div class="copyright-footer">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="pt-3 pb-3">
						<span class="copyright"><a target="_blank" href="<?php echo esc_url(__('https://iqonic.design/', 'geritcht')); ?>"> <?php printf(esc_html__('© 2021', 'geritcht'), 'geritcht'); ?><strong><?php printf(esc_html__(' geritcht ', 'geritcht'), 'geritcht'); ?></strong><?php printf(esc_html__('. All Rights Reserved.', 'geritcht'), 'geritcht'); ?></a></span>
					</div>
				</div>
			</div>
		</div>
	</div><!-- .site-info -->
<?php }
