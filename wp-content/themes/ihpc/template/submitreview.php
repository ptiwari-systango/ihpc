<?php
ob_start();
/**
 * Template Name: Submit review
 */
?>
<?php get_header('fullwidth'); 


//If form is submitted then creating a new review for a company also if company is not present then creating a company for that.
if( !empty($_POST) ){
	if( !is_user_logged_in() ){
		header("Location: $_SERVER[HTTP_REFERER]?err_msg=Please login to submit your review");
	}
	else{
		$insertArray 	= array();
		$err_msg 		= '';
		//Getting Title
		if( !empty($_POST['review_title']) ){
			$insertArray['post_title'] = $_POST['review_title'];
			//Getting Title
			if( !empty($_POST['review_text']) ){
				$insertArray['post_content'] = $_POST['review_text'];
				//Getting Company
				if( !empty($_POST['company']) ){
					$insertArray['company'] = $_POST['company'];
				}
				else{
					$err_msg = "Company is required";	
				}
			}
			else{
				$err_msg = "Review message is required";	
			}
		}
		else{
			$err_msg = "Review title is required";
		}
	    $insertArray['product_or_service'] 		= !empty($_POST['product_or_service']) ? $_POST['product_or_service']:'';
	    $insertArray['readed_term_of_services'] = !empty($_POST['readed_term_of_services']) ? 1:0;
	    $insertArray['post_status'] 			= 'pending';
	    $insertArray['post_type'] 				= 'review';
		
		//If no error message is set then insert the post.
		if( empty($err_msg) ){
			$review_inserted_id = wp_insert_post($insertArray);
			/****
			* Checking if company exists or not, if company exists then getting its company id else creating a new company
			****/
			$cmp_args1 = array(	'posts_per_page' => -1,
								'post_type' 	 => 'companies',
								'title' 		 => $insertArray['company']
							);
			$companies = get_posts( $cmp_args1 );
			if( !empty($companies) ){
				$company 	= $companies[0];
				$company_id = $company->ID;
			}
			else{
				$company_arg2 = array();
				$company_arg2['post_title'] 	= $insertArray['company'];
				$company_arg2['post_status'] 	= 'pending';
			    $company_arg2['post_type'] 		= 'companies';
				$company_id = wp_insert_post($company_arg2);			
			}
			if(!empty($company_id)){
				update_post_meta( $review_inserted_id, 'REVIEW_COMPANYID', $company_id);
			}
			//END:

			//If files are uploaded and post have been created
			if( !empty($_FILES) && !empty($review_inserted_id) ){
				foreach ($_FILES as $key => $file) {
					$file_nonce = $key."_nonce";
					$file_nme 	= $key;
					$attach_id  = upload_media_to_review_post( $file_nonce, $file_nme, $review_inserted_id );
					$upload_url = wp_get_attachment_url( $attach_id );
					//If key is add_photo then setting post thumbnail
					if( $key == 'add_photo'){
						///*update_post_meta( $review_inserted_id, 'review_submitted_image_url', $upload_url);*/
						set_post_thumbnail( $review_inserted_id, $attach_id );
					}
					//If key is add_video
					if( $key == 'add_video'){
						update_post_meta( $review_inserted_id, 'REVIEW_VIDEO_URL', $upload_url);
					}				
				}	
			}
			//saving the form fields in post meta
			update_post_meta( $review_inserted_id, 'review_accepted_terms_conditions', $insertArray['readed_term_of_services'] );
			update_post_meta( $review_inserted_id, 'review_product_or_service', $insertArray['product_or_service'] );
			header("Location: $_SERVER[HTTP_REFERER]?succ_msg=Your review has been saved, we will check and publish it shortly!!");
		}
		else{
			header("Location: $_SERVER[HTTP_REFERER]?err_msg=$err_msg");
		}	
	}	
}

?>

<div class="sub-header">	
	<main id="main" class="container" role="main">
		<div id="primary" class="row">
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="text-center entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<?php ihpc_edit_link( get_the_ID() ); ?>
				</header><!-- .entry-header -->
				<div class="entry-content text-center">
					<?php
						the_content();
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'ihpc' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->
			</article><!-- #post-## -->
			<?php endwhile; // End of the loop. ?>
		</div><!-- #primary -->
	</main><!-- #main -->	
</div><!-- .wrap -->
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php 
				if( !empty($_GET['err_msg']) ){
					echo "<div class='alert alert-danger'>".$_GET['err_msg']."</div>"; 
				}
				if( !empty($_GET['succ_msg']) ){
					echo "<div class='alert alert-success'>".$_GET['succ_msg']."</div>"; 
				}
			?>
			<form action="" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>Review Title*</label>
					<input type="text" class="form-control" name="review_title" required="required" >
				</div>
				<div class="form-group">
					<label for="formGroupExampleInput2">Review Text*</label>
					<textarea class="form-control" name="review_text" required="required"></textarea>
				</div>
				<div class="form-group">
					<label>Upload Photo</label>
					<input type="file" name="add_photo" />
				</div>
				<div class="form-group">
					<label>Upload Video</label>
					<input type="file" name="add_video" />
				</div>
				<div class="form-group">
					<label>Company*</label>
					<input type="text" class="form-control" name="company" required="required">
				</div>
				<div class="form-group">
					<label>Product or Service</label>
					<input type="text" class="form-control" name="product_or_service">
				</div>
				<div class="form-group">
					<input type="checkbox" required="required" name="readed_term_of_services" value="1"> I have read and agree to the I Hate Power Companies Terms of Services
				</div>
				<div class="form-group">
					<?php 
					wp_nonce_field( 'add_photo', 'add_photo_nonce' );
					wp_nonce_field( 'add_video', 'add_video_nonce' );
					?>
					<input type="submit" value="Proceed">
				</div>
			</form>
		</div>
	</div>
</div>

<?php 

//$_POST['add_photo_nonce']
function upload_media_to_review_post( $nonce, $file_name, $post_id ) {
	//if ( isset( $nonce ) && wp_verify_nonce( $nonce, $file_name ) ) {
		require_once( ABSPATH.'wp-admin/includes/image.php' );
		require_once( ABSPATH.'wp-admin/includes/file.php' );
		require_once( ABSPATH.'wp-admin/includes/media.php' );		
		$attachment_id = media_handle_upload( $file_name, $post_id );		
		if ( is_wp_error( $attachment_id ) ) {
			return 0;
		} 
		else {
			//return wp_get_attachment_url( $attachment_id );
			return $attachment_id;
		}
	/*} else {
		return "The security check failed, maybe show the user an error.";
	}*/
}


get_footer('fullwidth');
?>