<?php
/*
Template Name: work
Template Post Type: work
*/
/**
 * 
 
 * 
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elegant
 */

get_header();
?>
	<section class="work">
		<div class="container-fluid">
			<div class="row text-center justify-content-center">
			
				<div class="col-11 col-md-7 work-header">
					<h3>Our Amazing Work</h3>
					<h2>What We Do</h2>
					<p>Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius.</p>
				</div>
				<div class="col-12 d-flex flex-wrap justify-content-center p-0 work-content">	
				<?php
				global $query_string;
				query_posts($query_string.'&posts_per_page=8');
				if ( have_posts() ) :			
					
					
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
						save_data_post();
						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						?>
						<!-- Post content -->
						<article data-post-id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="thumbnail">
								<img src="<?php echo get_the_post_thumbnail_url(  ); ?>" alt="<?php echo get_the_post_thumbnail_caption( ); ?>" class="">
							</div>
						</article>
					<?php	
					endwhile;
					wp_reset_query();
					
				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>
			
				</div>
			</div>	
		</div>
		<div class="more-content" id="more-content">
			<div class="container  h-100 w-75 ">
				<div class="row ">
					<div class="col-12 col-md-5 box-picture ">
						<div class="thumbnail" id="thumbnail"></div>
					</div>
					<div class="col-12 col-md-7 box-content ">
						<h2 class="title"></h2>
						<p class="content"></p>
						<div class="list-picture my-5" id="list-picture"></div>
					</div>
				</div>
			</div>
		</div>
		<script>
			var works = <?php echo save_data_post('convert_json'); ?> 
			console.log(works);
		</script>
	</section>
<?php

get_footer();