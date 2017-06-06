<?php
// Register and load the widget
function wpb_load_widget() {
	register_widget( 'ihpc_most_active_users' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

// Creating the widget 
class ihpc_most_active_users extends WP_Widget {

	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'ihpc_most_active_users',
			// Widget name will appear in UI
			__('Most Active Users', 'wpb_widget_domain'), 
			// Widget description
			array( 'description' => __( 'This widget shows the most active user of your wordpress', 'wpb_widget_domain' ), ) 
		);
	}

	// Creating widget front-end
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];		
		$users_str = '';
		$args1 = array(	'orderby' => 'post_count',
						'order'   => 'DESC');
		$users = get_users( $args1 );
		foreach ($users as $key => $user) {
			//print_r($user);
			$user->data->ID."-".get_user_meta($user->data->ID,'user_profile_pic',true);
			$users_str .= "<div>
								<img src='https://placeholdit.imgix.net/~text?txtsize=33&txt=50%C3%9750&w=50&h=50' />
								<span>".$user->data->display_name."</span>
							</div>";
		}		
		echo __( $users_str , 'wpb_widget_domain' );
		echo $args['after_widget'];		
	}
		
	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Most Active Users', 'wpb_widget_domain' );
		}
		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
	}
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} // Class wpb_widget ends here
