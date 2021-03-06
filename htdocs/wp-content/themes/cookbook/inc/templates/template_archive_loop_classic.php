<?php 

	//GET OPTIONS
	$canon_options_post = get_option('canon_options_post'); 

	// VARS
	$excerpt_length = 700;
	$post_counter = 0;
	$search_query = get_search_query();

	//DETERMINE PAGE TYPE (home, page or category)
	$page_type = mb_get_page_type();

	//DETERMINE ARCHIVE STYLE
	if ($page_type == 'home' || $page_type == 'page') {                     // blog
		$excerpt_length = $canon_options_post['blog_excerpt_length'];
	} elseif ($page_type == 'category') {                                   // category
		$excerpt_length = $canon_options_post['cat_excerpt_length'];
	} else {
		$excerpt_length = $canon_options_post['archive_excerpt_length'];
	}

?>


					<!-- MAIN LOOP -->
					<?php while ( have_posts() ) : the_post(); ?>

                        <?php // if(!is_sticky() || $paged !== 1) : ?> <!-- uncomment to make stickies appear in the loop when not on page 1 -->
                        <?php if(!is_sticky()) : ?> <!-- uncomment to remove stickies from loop -->

							<?php 

								$post_format = get_post_format();
								$cmb_feature = get_post_meta(get_the_ID(), 'cmb_feature', true);
								$cmb_media_link = get_post_meta(get_the_ID(), 'cmb_media_link', true);
								$cmb_byline = get_post_meta(get_the_ID(), 'cmb_byline', true);
								$cmb_post_show_ratings = get_post_meta(get_the_ID(), 'cmb_post_show_ratings', true);
								$cmb_post_ratings_overall_score = get_post_meta(get_the_ID(), 'cmb_post_ratings_overall_score', true);
								$has_feature = mb_has_feature(get_the_ID());
								$the_excerpt = mb_get_excerpt(get_the_ID(), $excerpt_length);
								if (!empty($search_query)) { $the_excerpt = mb_tag_search_string($the_excerpt, $search_query, "<span class='highlight'>","</span>", false); }
								$post_counter++;

							?>



							<!-- STANDARD POST -->
							<?php if ($post_format === false) : ?>

								<div id="post-<?php the_ID(); ?>" <?php post_class("post-container single-item clearfix"); ?>>

									<!-- FEATURE CONTAINER -->
									<?php if ($has_feature) : ?>

										<div class="rate-container col-1-3">
											
											<!-- META: COMMENTS -->
											<?php if ($canon_options_post['show_meta_comments'] == "checked") { printf('<div class="comment-num"><a href="%s#comments">%s</a></div>', esc_url(get_the_permalink()), esc_attr(get_comments_number(get_the_ID()))); } ?>
											
											<!-- RATING -->
											<?php if ( $cmb_post_show_ratings == "checked" && !empty($cmb_post_ratings_overall_score) ) { printf('<div class="feat-title-container"><div class="rate-tab rate-big feat-block-1"><strong>%s</strong><i>%s</i></div></div>', esc_attr($cmb_post_ratings_overall_score), __('Score', 'loc_canon')); } ?>

											<!-- FEATURED IMAGE -->
											<?php get_template_part('inc/templates/template_featured_media_archive_classic'); ?>

										</div>
										

									<?php endif; ?>

									
									<!-- CONTENT -->
									<div class="<?php if ($has_feature) { echo "col-2-3 last"; } else { echo "col-1-1"; } ?>">

										<!-- TITLE -->
										<a href="<?php the_permalink(); ?>" class="title"><h1><?php the_title(); ?></h1></a>

										<!-- EXCERPT -->
										<?php echo wp_kses_post($the_excerpt); ?>
										
										
										<div class="clearfix readmore-container">

											<!-- READ MORE -->
											<?php printf('<a class="readmore left stay" href="%s">%s</a>', esc_url(get_the_permalink()), esc_attr(__('Read More', 'loc_canon'))); ?>

											<!-- META: PUBLISH DATE -->
											<?php 

												$archive_year  = get_the_time('Y'); 
												$archive_month = get_the_time('m'); 
												$archive_day   = get_the_time('d');                             

												if ($canon_options_post['show_meta_date'] == "checked") { printf('<ul class="meta right stay"><li><a class="date" href="%s">%s</a></li></ul>', esc_url(get_day_link( $archive_year, $archive_month, $archive_day)), esc_attr(mb_localize_datetime(get_the_time(get_option('date_format'))))); } 

											?>
										</div>
										
									</div> 

								</div>
								
							<?php endif; ?>
							<!-- END STANDARD POST -->



							<!-- MEDIA POST -->
							<?php if ( ($post_format === "video") || ($post_format === "audio") ) : ?>

								<div id="post-<?php the_ID(); ?>" <?php post_class("post-container single-item clearfix"); ?>>
									
									 
																	
									
									<!-- FEATURE CONTAINER -->
									<?php if ($has_feature) : ?>

										<div class="rate-container rate-video col-1-3">
											
											<!-- META: COMMENTS -->
											<?php if ($canon_options_post['show_meta_comments'] == "checked") { printf('<div class="comment-num"><a href="%s#comments">%s</a></div>', esc_url(get_the_permalink()), esc_attr(get_comments_number(get_the_ID()))); } ?>
											
											<!-- RATING -->
											<?php if ( $cmb_post_show_ratings == "checked" && !empty($cmb_post_ratings_overall_score) ) { printf('<div class="feat-title-container"><div class="rate-tab rate-small feat-block-1"><strong>%s</strong><i>%s</i></div></div>', esc_attr($cmb_post_ratings_overall_score), __('Score', 'loc_canon')); } ?>

											<!-- FEATURED IMAGE -->
											<?php get_template_part('inc/templates/template_featured_media_archive_classic'); ?>

										</div>

									<?php endif; ?>
									
									
									<div class="<?php if ($has_feature) { echo "col-2-3 last"; } else { echo "col-1-1"; } ?>">
										<!-- TITLE -->
										<a href="<?php the_permalink(); ?>" class="title"><h1><?php the_title(); ?></h1></a>
										
										<!-- EXCERPT -->
										<?php echo wp_kses_post($the_excerpt); ?>
										
										
										<div class="clearfix readmore-container">
											<!-- READ MORE -->
											<?php printf('<a class="readmore left stay" href="%s">%s</a>', esc_url(get_the_permalink()), esc_attr(__('Read More', 'loc_canon'))); ?>
		
											<!-- META: PUBLISH DATE -->
											<?php 
		
												$archive_year  = get_the_time('Y'); 
												$archive_month = get_the_time('m'); 
												$archive_day   = get_the_time('d');                             
		
												if ($canon_options_post['show_meta_date'] == "checked") { printf('<ul class="meta right stay"><li><a class="date" href="%s">%s</a></li></ul>', esc_url(get_day_link( $archive_year, $archive_month, $archive_day)), esc_attr(mb_localize_datetime(get_the_time(get_option('date_format'))))); } 
		
											?>
										</div>
									</div>    
									

								</div>

							<?php endif; ?>
							<!-- END MEDIA POST -->




							<!-- QUOTE POST -->
							<?php if ($post_format == "quote") : ?>

								<div id="post-<?php the_ID(); ?>" <?php post_class("post-container single-item clearfix"); ?>>

									<div class="boxy rate-container">

										<!-- META: COMMENTS -->
										<?php if ($canon_options_post['show_meta_comments'] == "checked") { printf('<div class="comment-num"><a href="%s">%s</a></div>', esc_url(get_the_permalink()), esc_attr(get_comments_number(get_the_ID()))); } ?>
											
										<blockquote>

											<!-- EXCERPT -->
											<?php printf('<a href="%s">%s</a>', esc_url(get_the_permalink()), wp_kses_post($the_excerpt)); ?>
										
											<!-- BYLINE -->
											<?php if (!empty($cmb_byline)) { printf(' <cite>- %s</cite>', esc_attr($cmb_byline)); } ?>
										   

										</blockquote>
										
									</div> 

								</div>

							<?php endif; ?>
							<!-- END QUOTE POST -->


						<!-- GALLERY POST -->

							<?php if ( ($post_format == "gallery") ) :

								// HANDLE POST SLIDER
								$consolidated_slider_array = array();

								$cmb_post_slider_source = get_post_meta( get_the_ID(), 'cmb_post_slider_source', true);
								$post_slider_array = mb_strip_wp_galleries_to_array($cmb_post_slider_source);
								$consolidated_slider_array = mb_convert_wp_galleries_array_to_consolidated_wp_gallery_array($post_slider_array);

								?>

								<div id="post-<?php the_ID(); ?>" <?php post_class("post-container single-item clearfix"); ?>>

									<!-- FEATURED MEDIA -->
									<?php
										

										if (empty($consolidated_slider_array)) {
											
											if ($has_feature) {

												echo "<div class='featured_media col-1-3'>";

												// FEATURED IMAGE
												if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) {
													output_cmb_media_link($cmb_media_link);
												} else {
													$post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
													$post_thumbnail_src_fit = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
													$img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
													$img_post = get_post(get_post_thumbnail_id(get_the_ID()));

													if ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && get_post(get_post_thumbnail_id(get_the_ID())) ) {

														echo '<div class="mosaic-block circle">';
														printf('<a href="%s" class="mosaic-overlay fancybox-media fancybox.iframe play"></a>', esc_url($cmb_media_link));
														printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src_fit[0]), esc_attr($img_alt));
														echo "</div>";
													
													} elseif (has_post_thumbnail(get_the_ID()) && get_post(get_post_thumbnail_id(get_the_ID())) ) { 

														echo '<div class="mosaic-block circle">';
														printf('<a href="%s" class="mosaic-overlay" title="%s"></a>', esc_url($post_thumbnail_src[0]), esc_attr($img_post->post_title));
														printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src_fit[0]), esc_attr($img_alt));
														echo "</div>";
													}
												}

												echo "</div>";

											}
												
										} else {
												
											echo '<div class="flexslider flexslider-default featured-media col-1-3"><ul class="slides">';
											for ($i = 0; $i < count($consolidated_slider_array); $i++) {  

												$post_thumbnail_src = wp_get_attachment_image_src($consolidated_slider_array[$i]['id'],'full');
												$img_alt = get_post_meta($consolidated_slider_array[$i]['id'], '_wp_attachment_image_alt', true);
												$img_post = get_post($consolidated_slider_array[$i]['id']);

												printf("<li><a title='%s' href='%s'><img src='%s' alt='%s'></a></li>", esc_attr($img_post->post_excerpt), esc_url(get_the_permalink()), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
											}
											echo '</ul></div>';
											
										}


									?>

									
									<div class="col-2-3 last">
										<!-- TITLE -->
										<a href="<?php the_permalink(); ?>" class="title"><h1><?php the_title(); ?></h1></a>
										
										<!-- EXCERPT -->
										<?php echo wp_kses_post($the_excerpt); ?>
										
										
										<div class="clearfix readmore-container">
											<!-- READ MORE -->
											<?php printf('<a class="readmore left stay" href="%s">%s</a>', esc_url(get_the_permalink()), esc_attr(__('Read More', 'loc_canon'))); ?>
		
											<!-- META: PUBLISH DATE -->
											<?php 
		
												$archive_year  = get_the_time('Y'); 
												$archive_month = get_the_time('m'); 
												$archive_day   = get_the_time('d');                             
		
												if ($canon_options_post['show_meta_date'] == "checked") { printf('<ul class="meta right stay"><li><a class="date" href="%s">%s</a></li></ul>', esc_url(get_day_link( $archive_year, $archive_month, $archive_day)), esc_attr(mb_localize_datetime(get_the_time(get_option('date_format'))))); } 
		
											?>
										</div>                      
									</div>

								</div>  


							<?php endif; ?>
							<!-- END GALLERY POST -->


						<!-- ADS -->

							<?php 

								// check for ad
								foreach ($canon_options_post['archive_ads'] as $key => $value) {


									// determine show
									$show_ads = false;
									if ($page_type == 'home' || $page_type == 'page') {                     // blog
										if ($value['show_ads_blog'] == "checked") { $show_ads = true; }
									} elseif ($page_type == 'category') {                                   // category
										if ($value['show_ads_category'] == "checked") { $show_ads = true; }
									} else {
										if ($value['show_ads_archive'] == "checked") { $show_ads = true; }
									}

									if ($show_ads) {
											
										// calculate post number
										$post_number = ( ($wp_query->query['paged']-1) * $wp_query->query_vars['posts_per_page'] ) + $post_counter;

										// if match then display
										$append_to_posts_string = $value['append_to_posts'];
										$ad_code = $value['ad_code'];
										$append_to_posts_array = explode(',', $append_to_posts_string);
										foreach ($append_to_posts_array as $key => $value) {
											$append_to_post_number = trim($value);
											if ($append_to_post_number == $post_number) {
												 
												echo '<div class="post-container single-item clearfix">';
												echo do_shortcode($ad_code);
												echo '</div>';
												   
											}
										}
									}

								}
										

							?>

                        <?php endif; ?>
                        <!-- END IF STICKY NOT-->



					<?php endwhile; ?>
					<!-- END LOOP -->