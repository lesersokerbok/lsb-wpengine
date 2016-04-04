<?php

/**
 * Adds My_Widget widget.
 */
class LSB_Boksok_Search_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'LSB_Boksok_Search_Widget', // Base ID
			__('Boksøk: Søkeskjema-widget', 'lsb-boksok-widgets'), // Name
			array( 'description' => __( 'Lar besøkende søke direkte i boksøk.no.', 'lsb-boksok-widgets' ), ) // Args
		);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}?>

		<div class="textwidget"><?php echo wpautop( $instance['description'] ); ?></div>
		<form action="http://boksok.no/" method="get">
			<?php if( ! empty ( $instance['main_cat_filter'] ) && $instance['main_cat_filter'] !== 'no-filter' ) : ?>
				<input name="hovedkategori" value="<?php echo $instance['main_cat_filter']; ?>" type="hidden">
			<? endif; ?>
        <div class="input-group">
          <input class="form-control" name="s" placeholder="<?php echo !empty( $instance['placeholder'] ) ? $instance['placeholder'] : ''; ?>" type="search">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><?php _e('Søk', 'lsb_bokso_widgets') ?></button>
          </span>
        </div>
    	</form>

		<?php
		echo $args['after_widget'];
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : __( 'Boksøk', 'lsb-boksok-widgets' );
		$description = isset( $instance['description'] ) ? $instance['description'] : __( 'Søk etter bøker på boksøk.no.', 'lsb-boksok-widgets' );
		$placeholder = isset( $instance['placeholder'] ) ? $instance['placeholder'] : __( 'Søk etter en forfatter, en tittel eller et tema!', 'lsb-boksok-widgets' );
		$main_cat_filter = isset( $instance['main_cat_filter'] ) ? $instance['main_cat_filter'] : 'no-filter';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Tittel:', 'lsb-boksok-widgets' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>">
				<?php _e( 'Beskrivelse:', 'lsb-boksok-widgets' ); ?>
			</label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" ><?php echo esc_attr( $description ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'placeholder' ); ?>">
				<?php _e( 'Søkefelt placeholder:', 'lsb-boksok-widgets' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'placeholder' ); ?>" name="<?php echo $this->get_field_name( 'placeholder' ); ?>" type="text" value="<?php echo esc_attr( $placeholder ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'main_cat_filter' ); ?>"><?php _e( 'Filtrer på kategori:', 'lsb-boksok-widgets' ); ?></label><br/>
			<select id="<?php echo $this->get_field_id( 'main_cat_filter' ); ?>" name="<?php echo $this->get_field_name( 'main_cat_filter' ); ?>">
				<option value="no-filter" <?php echo ('no-filter' == $main_cat_filter) ? 'selected' : ''; ?>><?php _e( 'Inget filter', 'lsb-boksok-widgets' ); ?></option>
				<option value="litt-a-lese" <?php echo ('litt-a-lese' == $main_cat_filter) ? 'selected' : ''; ?>>
          Litt å lese
        </option>
				<option value="enkelt-innhold" <?php echo ('enkelt-innhold' == $main_cat_filter) ? 'selected' : ''; ?>>
          Enkelt innhold
        </option>
				<option value="punktskrift-folebilder" <?php echo ('punktskrift-folebilder' == $main_cat_filter) ? 'selected' : ''; ?>>
          Punkskrift & følebilder
        </option>
				<option value="tegnsprak-nmt" <?php echo ('tegnsprak-nmt' == $main_cat_filter) ? 'selected' : ''; ?>>
          Tegnspråk & NMT
        </option>
				<option value="bliss-piktogram" <?php echo ('bliss-piktogram' == $main_cat_filter) ? 'selected' : ''; ?>>
          Bliss & piktogram
        </option>
			</select>
	<?php
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
		$instance['filter'] = ! empty( $new_instance['filter'] );
		$instance['placeholder'] = ( ! empty( $new_instance['placeholder'] ) ) ? strip_tags( $new_instance['placeholder'] ) : '';
		$instance['main_cat_filter'] = ( ! empty( $new_instance['main_cat_filter'] ) ) ? strip_tags( $new_instance['main_cat_filter'] ) : '';
		return $instance;
	}
} // class My_Widget
