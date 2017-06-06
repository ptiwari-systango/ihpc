<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div id="top-section">
	<div id="primary" class="col-lg-9">
		<?php // Show the selected frontpage content.
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/page/content', 'front-page' );
			endwhile;
		else : // I'm not sure it's possible to have no posts when this page is shown, but WTH.
			get_template_part( 'template-parts/post/content', 'none' );
		endif; 
		?>
		<div class="more_post_link text-right"><a href="<?php echo site_url('review') ?>">More featured reviews</a></div>
		<?php
		// Get each of our panels and show the post data.
		if ( 0 !== ihpc_panel_count() || is_customize_preview() ) : // If we have pages to show.
			/**
			 * Filter number of front page sections in Twenty Seventeen.
			 *
			 * @since Twenty Seventeen 1.0
			 *
			 * @param $num_sections integer
			 */
			$num_sections = apply_filters( 'ihpc_front_page_sections', 4 );
			global $ihpccounter;
			// Create a setting and control for each of the sections available in the theme.
			for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
				$ihpccounter = $i;
				ihpc_front_page_section( null, $i );
			}
		endif; // The if ( 0 !== ihpc_panel_count() ) ends here.
		?>

		<!-- Most recent review section: Start -->
		<div class="row">
			<div class="col-md-12 text-center">
				<?php
					$review1 = get_reviews(1);
					echo $review1[0]['excerpt'];
					echo "<a href='".$review1[0]['permalink']."'>Read More</a>";
					?>
			</div>
		</div>		
		<!-- End -->

		<!-- Most hated power companies section: start -->
		<div class="row">
			<div class="col-md-12"><h2>Most hated power companies</h2></div>			
			<?php echo most_hatted_power_companies(); ?>
			<div class="clearfix text-right"><a href="<?php echo site_url('companies') ?>">More Trends</a></div>
		</div>		
		<!-- End -->

		<!-- <div class="most_hated_power_companies">
			<h1>Top locations</h1>
			<?php //echo top_locations(); ?>
			<div class="more_post_link text-right"><a href="#">Show more locations</a></div>
		</div> -->

		<!-- Top rated power companies section: Start -->
		<div class="row">
			<div class="col-md-12">
				<h2>Top Rated Power Companies</h2>
				<?php 
					$companies = get_companies_by_ratings(-1,'DESC');
					foreach ($companies as $key => $company) {						
						if( $company['ihpc_ratings'] > 4){
							echo '<div>
								<a href="'.$company['url'].'">'.$company['title'].'</a> 
								<span>'.$company['ihpc_ratings'].' stars</span>
							</div>';
						}
					}
				?>
				<div class="clearfix text-right"><a href="<?php echo site_url('companies') ?>">Show more companies</a></div>
			</div>
		</div>		
		<!-- End -->

		<!-- Latest review, recently discussed and top rated section: Start -->
		<div class="row">
			<div class="col-md-4">
				<h2>Latest Reviews</h2>
				<?php 
				$reviews = get_reviews(3);
				foreach ($reviews as $key => $review) {
					echo '<div class="panel">
								<a href="'.$review['url'].'">'.$review['title'].'</a>
								<br/>
								<span>'.$review['date'].'</span>
							</div>';
				}				
				?>
			</div>
			<div class="col-md-4">
				<h2>Recently Discussed</h2>
				<?php
				$comments = get_ihpc_comments(3,'review');
				foreach ($comments as $key => $comment) {
					echo '<div class="panel">
							<div>'.$comment['excerpt'].'<br/>
							<span>'.$comment['date'].'</span>
							</div>
						</div>';
				}
				?>			
			</div>
			<div class="col-md-4">
				<h2>Most Hated</h2>
				<?php 
					$companies = get_companies_by_ratings(3,'ASC');
					foreach ($companies as $key => $company) {						
						echo '<div class="panel">
								<a href="'.$company['url'].'">'.$company['title'].'</a>
								<br/>
								<span>'.$company['date'].'</span>
							</div>';
					}
				?>
			</div>			
		</div>
		<!-- End -->
	</div><!-- #primary -->
	<aside class="col-lg-3" role="complementary">
		<?php
		if (function_exists ('adinserter')){
			echo adinserter (1);
		}
		if ( is_active_sidebar( 'frontpage-sidebar-1' ) ) { 
			dynamic_sidebar( 'frontpage-sidebar-1' );
		}
		if (function_exists ('adinserter')){
			echo adinserter (2);
		}
		?>	
	</aside><!-- .widget-area -->
</div>

<div id="slider-section" class="text-center">
	<!-- Add section for block 3 : Start -->
	<?php
	if (function_exists ('adinserter')){
		echo adinserter (3);
	}
	?>
	<!-- Add section for block 3 : End -->
</div>

<div id="bottom-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-9">
				<h2>Hate Categories</h2>
				<?php echo get_ihpc_categories('companiestax'); ?>
				<div class="clearfix"></div>
				<div class="text-right"><a href="<?php site_url('review') ?>">Browse all reviews</a></div>
			</div>
			<div class="col-lg-3">
				<?php
				if ( is_active_sidebar( 'frontpage-sidebar-2' ) ) { 
					dynamic_sidebar( 'frontpage-sidebar-2' );
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); 
