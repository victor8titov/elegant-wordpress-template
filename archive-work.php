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
				if ( have_posts() ) :			

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						?>
						<!-- Post content -->
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="thumbnail">
								<img src="<?php echo get_the_post_thumbnail_url(  ); ?>" alt="<?php echo get_the_post_thumbnail_caption( ); ?>" class="">
							</div>
							<div class="content">
							
							</div>
							
						</article>
					<?php	
					endwhile;
					// Навигация (ссылки на след. пред посты)
					the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>
			
				</div>
			</div>	
		</div>
	</section>




<?php
if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;
			
			?>

<?php


//get_sidebar();
get_footer();
