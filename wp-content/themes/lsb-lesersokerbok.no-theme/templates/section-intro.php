<?php if(get_sub_field('intro_text')) : ?>

	<?php
		$iframe = get_sub_field('intro_video');
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

	<?php if ( $iframe ) : ?>
		<div class="embed col-md-5">
    		<div class="embed-container <?php echo $oembed_type ?>">
      			<?php echo $iframe ?>
    		</div>
  		</div>
	<?php endif; ?>

	<div class="intro-text col-md-7">
    	<?php the_sub_field('intro_text'); ?>
	</div>

<?php endif; ?>
