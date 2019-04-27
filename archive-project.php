<?php
/*
Template Name: project
Template Post Type: project
/*
The main template file
*/
/**
 * 
 * 
 * 
 
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
	<!-- Project -->
<section class="project">

	<!-- ONE POST AND SIDEBAR MORE POSTS -->
	<div class="content container">
		<div class="row">
			<div class="col-12 col-lg-8">
				
				<?php 
				/* start custom loop */
					$myposts = get_posts( array(
						'post_type' 	=> 'project',
						'posts_per_page' => 1,
					));
					foreach ($myposts as $post):
						setup_postdata( $post );
						$first_id = get_the_ID();
						$stack_ID_images = get_post_meta( get_the_ID(), 'images');

						if ( has_post_thumbnail() ) :
							$html_string_thumbnail = get_the_post_thumbnail( get_the_ID(), 'large', array('class'=>'img-fluid'));
						endif;
						if ( $stack_ID_images ):
							foreach ($stack_ID_images as $ID_img) {
								$html_string_images_from_meta .= '<li class="box-img">' . wp_get_attachment_image( $ID_img, 'large' ) . '</li>';	
							}
						endif;
				?>	
				<article id="one-post" class="one-post">
					<header class="header">
						<?php
						the_title( '<h2 class="entry-title">', '</h2>' );
						?>
					</header><!-- .entry-header -->

					<div class="content-one-post">
						<?php
						the_content( );								
						?>
						<ul>
							<li class="box-img"><?php echo $html_string_thumbnail; ?></li>
							<?php echo $html_string_images_from_meta; ?>
						</ul>
					</div><!-- .entry-content -->			
				</article><!-- #post-<?php the_ID(); ?>  -->

				<?php
				endforeach;
				wp_reset_postdata();
				/* end custom loop */
				?>
			</div>
			<div class="col-12 col-lg-4">
				<aside class="sidebar">
					<ul>
						<?php
						/* GENERAL LOOP */
						global $query_string; // параметры базового запроса
						query_posts( $query_string .'&posts_per_page=6');
						if ( have_posts() ) :
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();
								if ( $first_id !== get_the_ID() ):
									$img = has_post_thumbnail( get_the_ID() ) ? get_the_post_thumbnail( get_the_ID() ) : get_the_title();

								?>

						<li class= "project-img">
							<a href="<?php the_permalink(); ?>">
								<?php echo $img; ?>
							</a>		
						</li>	

								<?php
							endif;	
							endwhile;
							wp_reset_query(); 
						else :

							get_template_part( 'template-parts/content', 'none' );

						endif;
						/* END GENERAL LOOP */
						?>
					</ul>
				</aside>				
			</div>
		</div>						
	</div>
	
<!-- SOCIAL LINK -->
<div class="container-fluid">
	<div class="row text-center justify-content-around social-box">
		<div class="col d-none d-lg-block"><a href="#" class="button">Facebook</a></div>
		<div class="col d-none d-lg-block"><a href="#" class="button">Twitter</a></div>
		<div class="col d-none d-lg-block"><a href="#" class="button">Google+</a></div>
	</div>
</div> 

</section><!-- // END PROJECT -->
<?php

get_footer();
