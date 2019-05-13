<?php
	

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
<article id="one-post" class="one-post" data-id="<?php the_ID(); ?>">
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


