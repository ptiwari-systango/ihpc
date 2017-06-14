<?php get_header(); ?>

<div class="row">
	<h1>Users</h1>
	<?php
	$args = array( 'role' => 'Subscriber' );
	$user_query = new WP_User_Query( $args );
	if ( ! empty( $user_query->results ) ) {
		foreach ( $user_query->results as $user ) :
			$user_id = $user->data->ID;
			$pro_pic = get_field('user_profile_pic','user_'.$user_id);
			if( empty($pro_pic) ){
				$pro_pic = get_stylesheet_directory_uri()."/assets/images/avatar_standart_light.png";
			}
			$user_full_name 	= $user->data->display_name;
			$user_review_count 	= count_user_posts( $user_id , 'review' );
			$user_comment_count = 0;
			$author_url 		= get_author_posts_url( $user_id );
			?>
				<!-- Author panel in loop -->
				<div class="col-md-3">
					<div><img src="<?php echo $pro_pic ?>" class="img-responsive"></div>
					<div>
						<a href="<?php echo $author_url; ?>">
							<?php echo $user_full_name; ?>
						</a>
					</div>
					<div>Columbia, South Carolina</div>
					<div>
						<a href="#"><?php echo $user_review_count; ?> reviews</a> 
						<a href="#"><?php echo $user_comment_count; ?> comments</a>
					</div>
				</div>
				<!-- End -->

			<?php
		endforeach;
	} 
	else {
		echo 'No users found.';
	}
	?>
</div>

<?php get_footer(); ?>
