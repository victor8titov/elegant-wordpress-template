<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Elegant
 */

get_header();
?>
<section class="box-404">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-8 text-center">
				<section class="error-404 not-found">
					<header class="page-header">
						<h3 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'elegant' ); ?></h3>
					</header><!-- .page-header -->

					<div class="content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'elegant' ); ?></p>

						<?php
						/* get_search_form(); */
						?>
						
						<?php
						$elegant_archive_content = '<p>' . esc_html__( 'Try looking in the monthly archives.', 'elegant' )  . '</p>';

						the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h>$elegant_archive_content" );

						the_widget( 'WP_Widget_Tag_Cloud' );
						?>

					</div><!-- .page-content -->
				</section><!-- .error-404 -->
			</div>
			<div class="col-12 col-lg-4">
				<!-- sidebar -->
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();
