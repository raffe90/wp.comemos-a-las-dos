<!-- TEMPLATE HEADER: main_image -->

<?php
    
    // GET OPTIONS
    $canon_options = get_option('canon_options');
    $canon_options_frame = get_option('canon_options_frame');

    extract($canon_options_frame);

    // DEV MODE OPTIONS
    if ($canon_options['dev_mode'] == "checked") {
        if (isset($_GET['use_sticky_header'])) { $canon_options_frame['use_sticky_header'] = wp_filter_nohtml_kses($_GET['use_sticky_header']); }
    }

?>



<?php 

    if ( ( $canon_options_frame['header_img_homepage_only'] == 'checked' && is_front_page() ) || ( $canon_options_frame['header_img_homepage_only'] != 'checked') ) {
    ?>


        <!-- Start Outter Wrapper -->
        <div class="outter-wrapper header-container image-header-container canon-parallax <?php if ($canon_options_frame['use_sticky_header'] == 'checked') { echo "canon_sticky"; } ?>" data-canon-parallax-amount="<?php echo esc_attr($header_img_parallax_amount); ?>" data-canon-parallax-yoffset="<?php echo esc_attr($header_img_parallax_yoffset); ?>">
            
            <style type="text/css" scoped>
                .outter-wrapper.header-container {
                    <?php if (!empty($header_img_url)) { echo "background-image: url('$header_img_url');"; } ?>
                    <?php if (intval($header_img_parallax_yoffset) !== 0) { echo "background-position: center ". $header_img_parallax_yoffset ."px;"; } ?>
                    <?php if (!empty($header_img_bg_color)) { echo "background-color: $header_img_bg_color;"; } ?>
                    <?php if (!empty($header_img_height)) { echo "height: " . $header_img_height ."px;"; } ?>
                }

                .outter-wrapper.image-header-container .header_img_text {
                    <?php if (!empty($header_img_text_margin_top)) { echo "margin-top: " . $header_img_text_margin_top ."px;"; } ?>
                }

           </style>

            <!-- Start Main Navigation -->
            <div class="wrapper">
                <header class="clearfix <?php echo esc_attr($canon_options_frame['header_img_text_alignment']); ?>">

                    <div class="header_img_text">
                        <?php echo do_shortcode($canon_options_frame['header_img_text']); ?>
                    </div>

                </header>
            </div>
            <!-- End Main Navigation -->
        </div>
        <!-- End Outter Wrapper -->    
            
    <?php    
    }

?>

