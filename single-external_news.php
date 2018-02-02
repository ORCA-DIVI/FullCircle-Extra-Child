<?php get_header(); ?>
<div id="main-content">
	<div class="container">
		<div id="content-area" class="<?php extra_sidebar_class(); ?> clearfix">
			<div class="et_pb_extra_column_main">
				<h1>Fulton Schools: In the News</h1>	
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'external_news external_news_single' ); ?>>
					<div class="post-wrap">
						<div class="post-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</div>
						<div class="post-meta">
							<h3>
							<?php
								$terms = get_the_terms( $post->ID , 'publication' );
								if (!empty($terms)) {
									echo '<i class="far fa-fw fa-newspaper"></i>';
									foreach ( $terms as $term ) {echo $term->name;}
								};
							?>
							<?php the_date('F j, Y', '<span><i class="far fa-fw fa-calendar-alt"></i>&nbsp;', '</span>'); ?>
						</div>
						
						<?php if ( ( et_has_post_format() && et_has_format_content() ) || ( has_post_thumbnail() && is_post_extra_featured_image_enabled() ) ) { ?>
							<div class="post-thumbnail header">
								<?php
								$score_bar = extra_get_the_post_score_bar();
								$thumb_args = array( 'size' => 'extra-image-single-post' );
								require locate_template( 'post-top-content.php' );
								?>
							</div>
						<?php } ?>
						<div class="post-content entry-content">
							<?php the_content(); ?>
							<?php
								wp_link_pages( array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'extra' ),
									'after'  => '</div>',
								) );
							?>
						</div>
					</div><!-- /.post-wrap -->
				</article>
				<?php
					endwhile;
				else :
					?>
					<h2><?php esc_html_e( 'Post not found', 'extra' ); ?></h2>
					<?php
				endif;
				?>
			</div><!-- /.et_pb_extra_column.et_pb_extra_column_main -->

			<?php get_sidebar(); ?>

		</div> <!-- #content-area -->
	</div> <!-- .container -->
</div> <!-- #main-content -->

<?php get_footer();
