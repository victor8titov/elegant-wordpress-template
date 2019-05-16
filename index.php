<?php
/**
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
<!-- Blog -->
<section class="blog">
<div class="container">
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="content">
                <?php
                //global $query_string; // параметры базового запроса
                //query_posts( $query_string .'&posts_per_page=2' );
                if ( have_posts() ) :

                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();

                        /*
                        * Include the Post-Type-specific template for the content.
                        * If you want to override this in a child theme, then include a file
                        * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                        */
                        get_template_part( 'template-parts/content', get_post_type() );

                    endwhile;
                    wp_reset_query(); // сброс запроса
                   // the_posts_navigation();

                else :

                    get_template_part( 'template-parts/content', 'none' );

                endif;
                ?>
            </div>
        </div>
        <div class="col-12 col-lg-4 ">
            <!-- sidebar -->
                <?php get_sidebar(); ?>
        </div>
        <div class="col-12 text-center">
            <div class="load">
                <?php if ( $wp_query->max_num_pages > 1 ) : ?>
                <script>
                var ajaxQueryPosts = {
                    url: '<?php echo site_url() ?>/wp-admin/admin-ajax.php',
                    query_vars: '<?php echo serialize($wp_query->query_vars); ?>',
                    current_page: <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>,
                    max_pages: '<?php echo $wp_query->max_num_pages; ?>',
                }                
                </script>
                <a href="#" class="button" id="load-more-post">Load More Posts</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

</section>

<?php

get_footer();
