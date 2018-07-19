<?php
class DonateButton_Widget extends WP_Widget {
    public function __construct() {
        $widget_ops = array(
            'classname' => 'donatebutton_widget',
            'description' => 'Customizable donate button'
        );
        parent::__construct( 'donatebutton_widget', 'Donate Button Widget', $widget_ops );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        ?>
    <span class="header-btn">
        <a href="<?php echo esc_url($instance['donate-link'] );?>" class="button"><?php echo esc_html($instance['donate-button-text'] );?></a>
    </span>
        <?php
        echo $args['after_widget'];
    }

    public function form( $instance ) {
        $buttonText = ! empty( $instance['donate-button-text'] ) ? $instance['donate-button-text'] : esc_html__( 'Donate Now', 'text_doman' );
        $donateLink = ! empty( $instance['donate-link'] ) ? $instance['donate-link'] : home_url( '#' );
        ?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'donate-button-text' ) ); ?>"><?php esc_attr_e( 'Button Text:', 'text_domain' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'donate-button-text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'donate-button-text' ) ); ?>" type="text" value="<?php echo esc_attr( $buttonText ); ?>">
		</p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'donate-link' ) ); ?>"><?php esc_attr_e( 'Button Link:', 'text_domain' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'donate-link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'donate-link' ) ); ?>" type="text" value="<?php echo esc_attr( $donateLink ); ?>">
		</p>

        <?php
    }

    public function update( $new_instance, $old_instance ) {
		$instance = array();
        $instance['donate-button-text'] = ( ! empty( $new_instance['donate-button-text'] ) ) ? sanitize_text_field( $new_instance['donate-button-text'] ) : '';
        $instance['donate-link'] = ( ! empty( $new_instance['donate-link'] ) ) ? sanitize_text_field( $new_instance['donate-link'] ) : '';

		return $instance;
    }
}


function donate_button_widget_init() {
    register_widget( 'DonateButton_Widget' );
}
add_action( 'widgets_init', 'donate_button_widget_init' );
?>