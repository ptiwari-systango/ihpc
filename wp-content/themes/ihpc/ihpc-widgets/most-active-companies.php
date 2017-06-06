<?php
// Register and load the widget
function wpb_load_companies_widget() {
	register_widget( 'ihpc_most_active_companies' );
}
add_action( 'widgets_init', 'wpb_load_companies_widget' );

// Creating the widget 
class ihpc_most_active_companies extends WP_Widget {

	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'ihpc_most_active_companies',
			// Widget name will appear in UI
			__('Most Active Companies', 'wpb_widget_domain'), 
			// Widget description
			array( 'description' => __( 'This widget shows the most active companies of your wordpress', 'wpb_widget_domain' ), ) 
		);
	}

	// Creating widget front-end
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];
		$args = array('posts_per_page' => 4,
					'post_type'	=> 'companies',
					'orderby'  	=> 'date',
					'order' 	=> 'DESC'
				);
		$users_str = '';
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) {		
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$ratting = get_post_meta(get_the_ID(), 'ratings_average', true);
				$users_str .= '<div><a href="'.get_permalink().'">'.get_the_title().'</a></div>';
			}
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
			$title = __( 'Most Active Companies', 'wpb_widget_domain' );
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
