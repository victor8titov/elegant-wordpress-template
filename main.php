<?php
/* 
Template Name: Main page
*/

get_header();

        

   
?>

<section class="main">
    
        <?php
            if (have_posts() ):
            /* Start the Loop */
            while ( have_posts() ) :
                the_post();
                $id = get_the_ID();
                $main_content = get_the_content();
            endwhile;
            endif;
        ?>
        <?php if ($main_content): ?>
        <!-- SECTION MAIN -->
        <div class="wrapper">
            <section class="main-loop">
                    <?php echo apply_filters( 'the_content', $main_content ); ?>
            </section>
        </div>
        <?php endif; ?>
    
    <!-- SECTION ABOUT -->
    <?php 
        if ( get_post_meta( $id, 'about_show') ):
    ?>
    <div class="wrapper text-center">
        <section class="about">
            <h3>Who we are</h3>
            <h2><?php echo get_post_meta( $id, 'about_title',true); ?></h2>
            <p><?php echo get_post_meta( $id, 'about_text',true); ?></p>
            <a href="<?php echo get_post_meta( $id, 'about_link', true); ?>" class="button">Read More About Us</a>
        </section>
    </div>
    <?php endif; ?>

    <!-- SECTION WORK -->
    <?php 
        if ( get_post_meta( $id, 'work_show') ):
    ?>
    <section class="main-work container-fluid">
        <div class="row text-center">
            <div class="col-12">
                <div class="head">
                    <h3>What we do</h3>
                    <h2>Show Your Amazing Work</h2>
                </div>    
            </div>
            <div class="col-12 p-0">
                <div class="works d-flex flex-wrap justify-content-around ">
                    <?php
                        $myposts = get_posts( array(
                            'post_type' => 'work',
                            'posts_per_page' => 8,
                        ) );
                        
                        foreach ( $myposts as $post ):
                            setup_postdata( $post );
                    ?>
                    
                    <article class="post-work">
                        <a href="<?php echo get_post_type_archive_link('work'); ?>">
                        <?php echo get_the_post_thumbnail( get_the_ID($post), 'full' ); ?>
                        </a>
                    </article>

                    <?php        
                        endforeach;
                        wp_reset_postdata(); // сбрасываем переменную $post
                    ?>    
                    
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- SECTION PEOPLE -->
    <?php if(get_post_meta( $id, 'people_show')): ?>
    <section class="wrapper team">
        <div class="head text-center">
            <h3>Who we are</h3>
            <h2><?php echo get_post_meta( $id, 'people_title',true); ?> </h2>
            <p><?php echo get_post_meta( $id, 'people_text',true); ?></p>
        </div>
        <div class="peoples d-flex flex-wrap flex-md-nowrap justify-content-around">
            <?php
                $myposts = get_posts( array(
                    'post_type' => 'people',
                    'posts_per_page' => 3,
                ) );
                
                foreach ( $myposts as $post ):
                    setup_postdata( $post );
            ?>
            
            <article class="post-people flex-md-grow-1 mx-md-1">
                <?php echo get_the_post_thumbnail( get_the_ID($post), 'full' ); ?>
                <h3><?php echo get_post_meta( get_the_ID($post), 'people_prof',true); ?></h3>
                <h4><?php the_title(); ?></h4>
                <?php the_content(); ?>
            </article>

            <?php        
                endforeach;
                wp_reset_postdata(); // сбрасываем переменную $post
            ?> 
        </div>
    </section>
    <?php endif; ?>

    <!-- SECTION LAST POST -->
    <?php if(get_post_meta( $id, 'post_show')): ?>
    <section class="wrapper last-post text-center">
        <div class="last-post-head">
            <h3>Last Post</h3>
            <h2>We like to Write</h2>
        </div>
        <div class="last-post-body text-left">
        <?php
                $myposts = get_posts( array(
                    'post_type' => 'post',
                    'posts_per_page' => 1,
                ) );
                
                foreach ( $myposts as $post ):
                    setup_postdata( $post );
            ?>
            
                <?php echo get_the_post_thumbnail( get_the_ID($post), 'full' ); ?>
                <div class="text-post">
                    <h5><?php echo get_the_time('d F Y'); ?></h5>
                    <h4><?php the_title(); ?></h4>
                    <p><?php echo wp_trim_words( get_the_content(), 20, ' ...' ); ?></p>
                    <a href="<?php echo get_permalink(); ?>" class="button">Read</a>
                </div>

            <?php        
                endforeach;
                wp_reset_postdata(); // сбрасываем переменную $post
            ?>      
        </div>
        <div class="last-post-footer">
            <a href="<?php echo get_permalink(23); ?>" class="button">More From Our Blog</a>
        </div>
    </section>
    <?php endif; ?>

    <!-- SECTION CONTACT -->
    <?php if (get_post_meta($id, 'contact_show') ): 
        $contact = array(
            'location'  => array_shift (get_post_meta($id, 'contact_location') ),
            'phone'     => array_shift( get_post_meta($id, 'contact_phone') ),
            'fax'       => array_shift( get_post_meta( $id, 'contact_fax') ),
            'email'     => array_shift( get_post_meta( $id, 'contact_email') ),
        );
    ?>
    <section class="main-contact wrapper">
        <div class="row">
            <div class="col-12 p-0">
                <section class="main-contact-head text-center">
                    <h3>Contact us</h3>
                    <h2>Work With Us</h2>
                </section>
            </div>
            <div class="col-12 p-0">
            <section class="main-contact-map">
                <div id="map"></div>
                <script>                                   
                    var stack_adress = <?php echo json_encode( $contact['location'] ); ?>;
                </script>
                
            </section>
            </div>
            <div class="col-6 p-0">
                <section class="main-contact-location text-center">
                    <h4>Location</h4>
                    
                    <?php foreach( $contact['location'] as $address): ?>
                            <h5><?php echo $address; ?></h5>
                    <?php endforeach; ?>        
            </section>
            </div>
            <div class="col-6 p-0">
                <section class="main-contact-phone text-center">
                    <h4>Phone</h4>
                    <?php foreach( $contact['phone'] as $address): ?>
                            <h5><?php echo $address; ?></h5>
                    <?php endforeach; ?>        
            </section>
            </div>
            <div class="col-6 p-0">
                <section class="main-contact-fax text-center">
                    <h4>Fax</h4>
                    <?php foreach( $contact['fax'] as $address): ?>
                            <h5><?php echo $address; ?></h5>
                    <?php endforeach; ?>        
            </section>
            </div>
            <div class="col-6 p-0">
                <section class="main-contact-email text-center">
                    <h4>EMAIL</h4>
                    <?php foreach( $contact['email'] as $address): ?>
                            <h5><?php echo $address; ?></h5>
                    <?php endforeach; ?>        
            </section>         
            </div>
        </div>
    </section>
    <?php endif; ?>
</section>



<?php
 
 


get_footer();
?>
