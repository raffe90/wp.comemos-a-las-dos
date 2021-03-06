<?php /* Template Name: Page Full Width*/ ?>

<?php get_header(); ?>

<?php
    
    // SETTTINGS
    $cmb_page_hide_title = get_post_meta($post->ID, 'cmb_page_hide_title', true);

    // VC CMB ARRAY CONVERSION FIX
    if (is_array($cmb_page_hide_title)) { $cmb_page_hide_title = "checked"; }

?>

    <!-- BEGIN LOOP -->
    <?php while ( have_posts() ) : the_post(); ?>

   	
        <!-- Start Outter Wrapper -->
        <div class="outter-wrapper body-wrapper">       
            <div class="wrapper clearfix">
                
                <!-- Main Column -->
                <div class="col-1-1">
                
                    <!-- FEATURED IMAGE -->
                    <?php

                        if (has_post_thumbnail(get_the_ID())) { 
                        ?>

                            <div class="feature-image">
                                <?php the_post_thumbnail(); ?>
                            </div>

                        <?php
                        } 

                    ?>

                    <div class="clearfix post">

                        <!-- THE TITLE -->  
                        <?php if ($cmb_page_hide_title != "checked") { printf("<h1 class='title'>%s</h1>", esc_attr(get_the_title())); } ?> 

                         <!-- THE CONTENT -->
                        <div class="single-content"><?php the_content(); ?></div>
                        
                        <!-- WP_LINK_PAGES -->
                        <?php wp_link_pages(array('before' => '<p>' . __('Pages:','loc_canon'))); ?>

                    </div>
                    
                </div>              
                <!-- End Main Column -->    
            </div>
        </div>
        

    	
    <?php endwhile; ?>
    <!-- END LOOP -->


<?php get_footer(); ?>