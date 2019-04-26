<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elegant
 */

?>
<?php
	$img = has_post_thumbnail( get_the_ID() ) ? get_the_post_thumbnail( get_the_ID() ) : get_the_title();
?>

		<?php if ( $first_post ): ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php
					the_title( '<h2 class="entry-title">', '</h2>' );
					?>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php
						
					the_content(  );

					if ( has_post_thumbnail() ) :
						echo get_the_post_thumbnail( get_the_ID(), 'large', array('class'=>'img-fluid'));
					endif;					
					?>
				</div><!-- .entry-content -->			
			</article><!-- #post-<?php the_ID(); ?>  -->
		<?php endif; ?>
	</div>
	<div class="col-12 col-sm-4">
		<aside class=sidebar>
			<ul>
			<?php if ( !$first_post ):	?>
				<li class= "project-img">
					<a href="<?php the_permalink(); ?>">
						<?php echo $img; ?>
					</a>		
				</li>		
			<?php endif; ?>
			</ul>
		</aside>				
	</div>
</div>

<?php $first_post = false; ?>



