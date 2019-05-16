<?php
/**
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

                        get_template_part('template-parts/content');

                    endwhile;
                    wp_reset_query(); // сброс запроса

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
