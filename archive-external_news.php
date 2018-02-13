<?php
get_header(); ?>
<div id="main-content">
	<div class="container">
		<div id="content-area" class="<?php extra_sidebar_class(); ?> clearfix">
			<div class="et_pb_extra_column_main">
				<div class="et_pb_extra_column et_pb_extra_column_4_4">
					<div class="timeline-container">
						<div id="timeline-sticky-header" class="et_extra_other_module timeline-module">
							<div class="module-head">
								<h1 class="module-title-month"></h1>
								<span class="module-filter module-title-year"></span>
							</div>
						</div>
						<div id="external-timeline" class="timeline mobile">
						<?php $externalnews_timeline_posts = externalnews_get_timeline_posts_onload(); ?>
							
							<!-- from external template -->
							<?php
							global $wp_locale;

							$current_month = '';
							$current_year = '';
							$current_month_number = '';
							?>
							
							<?php
							if ( $externalnews_timeline_posts->have_posts() ) :
								while ( $externalnews_timeline_posts->have_posts() ) : $externalnews_timeline_posts->the_post(); ?>
								<?php
								$post_month = strtolower( get_the_time( 'F' ) );
								$post_year = strtolower( get_the_time( 'Y' ) );
								$post_month_number = get_the_time( 'm' );
								if ( $post_month != $current_month || $post_year != $current_year ) {

								?>
								<?php if ( !empty( $current_month ) ) { //need to close up existing month grouping ?>
									</ul><!-- /.posts-list -->
								</div><!-- /.timeline-module -->
								<?php } ?>
								<?php
								$current_month = $post_month;
								$current_month_number = $post_month_number;
								$current_year = $post_year;

								// start new month grouping
								printf(
									'<div class="timeline-module et_extra_other_module year-%1$d" data-year="%1$d" data-month="%2$s" id="%2$s_%1$d" style="border-top-color:%4$s">
									<div class="module-head">
										<h1 class="module-title-month">%3$s</h1>
										<span class="module-filter module-title-year">%1$d</span>
									</div>
									<ul class="posts-list">',
									esc_attr( $current_year ),
									esc_attr( $current_month ),
									esc_html( $wp_locale->get_month( $current_month_number ) ),
									esc_attr( extra_global_accent_color() )
								);

								} // end conditional group header logic

								// begin post creation
								?>
								<li>
									<article class="post">
										<div class="post-meta">
											<h4>
												<?php
													$terms = get_the_terms( get_the_ID() , 'publication' );
													if (!empty($terms)) {
														echo '<i class="far fa-fw fa-newspaper"></i>';
														foreach ( $terms as $term ) {echo $term->name;}
													};
												?>
												<i class="far fa-fw fa-calendar-alt"></i><?php echo get_the_date( 'F j, Y'); ?>
											</h4>
										</div>
										<div class="entry-content">
											<?php $externallink = carbon_get_the_post_meta( 'itn_mainurl' ); ?>
											<h3 class="post-title"><a href="<?php echo $externallink; ?>" title="<?php the_title_attribute(); ?>" target="_blank"><?php the_title(); ?></a></h3>
											<!-- Thumbnail -->
											<?php
											if (empty($externallink)) {
												$externallink = get_permalink();
											};

											$thumb = et_extra_get_post_thumb(array(
												'size'    => 'extra-image-medium',
												'a_class' => array( 'post-thumbnail' ),
												'permalink' => $externallink,
											));

											if ( $thumb ) {
												echo $thumb;
											} ?>

											<div class="post-content">
												<?php 
												$complex = carbon_get_the_post_meta( 'itn_use_excerpt' );
												if ( $complex ) {
													the_excerpt();
													echo '<p class="alignright"><a class="button" href="';
													echo the_permalink();
													echo '" title="';
													echo the_title_attribute();
													echo '">Read More</a></p>';
												} else {
													the_content();
												}
												?>
											</div><!-- end .post-content -->
										</div>
									</article>
								</li>
							<?php
								endwhile;
								wp_reset_postdata();

								// close last group
								?>
								</ul><!-- /.posts-list -->
							</div><!-- /.timeline-module -->
							<?php
							endif; ?>

							<div class="loader">
								<?php extra_ajax_loader_img(); ?>
							</div>
						</div>
						<div class="timeline-nav">
							
							<ul id="external-timeline-menu" class="timeline-menu">
								<?php
								$month_groups = externalnews_get_timeline_menu_month_groups();
								$current_year = '';

								foreach ( $month_groups as $month_group ) {

									list( $month, $year ) = explode( '-', $month_group );

									if ( $year != $current_year ) {
										printf( '<li class="year year-%1$d">%1$d</li>', esc_attr( $year ) );
										$current_year = $year;
									}

									printf( '<li class="month year-%1$d"><a href="#%2$s_%1$d" data-year="%1$d">%3$s</a></li>', esc_attr( $year ), esc_attr( strtolower( $month ) ), esc_html( $month ) );

									?>
									<?php
								}
								?>
							</ul>
						</div>
					</div><!-- /.timeline-container -->
				</div><!-- /.et_pb_extra_column_main -->


			</div><!-- /.et_pb_extra_column_main -->

			<?php get_sidebar(); ?>

		</div> <!-- #content-area -->
	</div> <!-- .container -->
</div> <!-- #main-content -->

<?php get_footer();
