<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Elegant
 */

get_header();
?>
<!-- Single post -->
<section class="single-post">
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
                        get_template_part('template-parts/content');

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
       
    </div>
</div>
</section>
<?php
get_footer();
