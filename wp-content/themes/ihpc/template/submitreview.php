<?php
ob_start();
/**
 * Template Name: Submit review
 */
?>
<?php get_header('fullwidth'); ?>

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

<?php
$reviewId 	= $_GET['reviewId'];
$screen_no 	= $_GET['screen_no'];
switch ($screen_no) {
	case '2':
		include_once "review_forms/how_you_feel_form.php";
	break;
	case '3':
		include_once "review_forms/company_location_on_map.php";
	break;
	case '4':
		include_once "review_forms/make_your_review_easier_to_discover.php";
	break;
	default:
		include_once "review_forms/default_form.php";
	break;
}
?>

<script type="text/javascript">
jQuery(document).on('submit', '#step1', function(e){
    e.preventDefault();
    var fd 		= new FormData();
    var images 	= jQuery(document).find('input[name="add_photo[]"]');
    var videos 	= jQuery(document).find('input[name="add_video[]"]');
    var data 	= jQuery(this).serialize();
    //Adding photos in data
    for (var i = 0; i < images.length; i++) {
    	var add_image = "add_photo"+"-"+i;
    	fd.append(add_image,images[i].files[0]);
    };
    //Adding videos in data
    for (var i = 0; i < videos.length; i++) {
    	var add_video = "add_video"+"-"+i;
    	fd.append(add_video,videos[i].files[0]);
    };
    fd.append("form_json", data);  
    fd.append('action', 'submit_reivew_form');

    jQuery.ajax({
        type: 'POST',
        url: "<?php echo admin_url('admin-ajax.php'); ?>",
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
            window.location.href="response";
        }
    });
});
</script>

<?php get_footer('fullwidth'); ?>