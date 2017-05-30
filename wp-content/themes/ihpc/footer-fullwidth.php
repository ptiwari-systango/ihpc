<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

		<div class="clearfix"></div>
	<footer id="colophon" class="site-footer" role="contentinfo">		
		<div class="ipccf_footer">
			<div class="container">
			  <h1 class="text-center">I Hate Power Companies Consumer Facts</h1>
			  <div class="col-lg-4 text-center">
				<h2>500K</h2>
				<span>Reviews </span> </div>
			  <div class="col-lg-4 text-center">
				<h2>53K</h2>
				<span>Companies </span> </div>
			  <div class="col-lg-4 text-center">
				<h2> 127 </h2>
				<span>Industries </span> </div>
			</div>
	  </div>
	  
	  
<div class="footer-sitemap" id="footer-sitemap">
    <div class="container">
	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-3' ); ?>
	<?php endif; ?>
      
    </div>
  </div>
  
  	<?php if ( is_active_sidebar( 'footer-policy' ) ) : ?>
		<?php dynamic_sidebar( 'footer-policy' ); ?>
	<?php endif; ?>  
  	<!-- .wrap -->
		</footer><!-- #colophon -->
<?php wp_footer(); ?>

<script type="text/javascript">
jQuery(window).scroll(function(){
  if (jQuery(window).scrollTop() >= 50) {
    jQuery('.sticky-header').addClass('fixed');
   }
   else {
    jQuery('.sticky-header').removeClass('fixed');
   }
});
</script>
</body>
</html>
