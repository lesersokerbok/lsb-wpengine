<div class="block-wrapper">
<?php if ( have_rows('blocks') ): ?>
	<?php while ( have_rows('blocks') ) : the_row(); ?>

		<div class="block">
		<?php if( get_row_layout() == 'grid_block_text' ): ?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">
						<?php if ('external' == get_sub_field('grid_block_text_url_type') && get_sub_field('grid_block_text_external_url')) : ?>
							<a href="<?php the_sub_field('grid_block_text_external_url') ?>">
								<?php the_sub_field('grid_block_text_title'); ?>
							</a>
						<?php elseif ('internal' == get_sub_field('grid_block_text_url_type') && get_sub_field('grid_block_text_internal_url')) : ?>
							<a href="<?php the_sub_field('grid_block_text_internal_url') ?>">
								<?php the_sub_field('grid_block_text_title'); ?>
							</a>
						<?php else : ?>
							<?php the_sub_field('grid_block_text_title'); ?>
						<?php endif; ?>
					</h2>
				</div>
  				<div class="panel-body">
    				<?php the_sub_field('grid_block_text_content'); ?>
  				</div>
			</div>


		<?php elseif( get_row_layout() == 'grid_block_oembed' ): ?>

			<?php
				$iframe = get_sub_field('grid_block_oembed');
				preg_match('/src="(.+?)"/', $iframe, $matches);
				if( $matches ) {
					$src = $matches[1];
					$oembed_type = '';
					if(preg_match('/youtube/', $src)) {
						$oembed_type = 'youtube';
					} else if (preg_match('/issuu/', $src)) {
						$oembed_type = 'issuu';
					}
				}
			?>

			<div class="embed">
				<div class="embed-container <?php echo $oembed_type ?>">
					<?php the_sub_field('grid_block_oembed'); ?>
				</div>
			</div>

		<?php endif; ?>
		</div>

	<?php endwhile; ?>
<?php endif; ?>
</div>
