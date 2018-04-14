<?php

$related_post_ids = array();

// Exclude sticky posts and the current post
$exclude = get_option( 'sticky_posts' );
$exclude[] = $post->ID;

// Arguments used by all the queries below
$base_args = array(
	'orderby' 			=> 'rand',
	'post__not_in' 		=> $exclude,
	'post_status' 		=> 'publish',
	'posts_per_page' 	=> 4,
);

// Check categories first
$categories = wp_get_post_categories( $post->ID );

if ( $categories ) {

	$categories_args = $base_args;
	$categories_args['category__in'] = $categories;

	$categories_posts = get_posts( $categories_args );

	foreach ( $categories_posts as $categories_post ) {
		$related_post_ids[] = $categories_post->ID;
	}
}

// If we don't get four posts from that, fill up with posts selected at random
if ( count( $related_post_ids ) < 4 ) {

	// Only with as many as we need though
	$random_post_args = $base_args;
	$random_post_args['posts_per_page'] = 4 - count( $related_post_ids );

	$random_posts = get_posts( $random_post_args );

	foreach ( $random_posts as $random_post ) {
		$related_post_ids[] = $random_post->ID;
	}
}

// Get the posts we've scrambled together
$related_posts_args = $base_args;
$related_posts_args['include'] = $related_post_ids;

$related_posts = get_posts( $related_posts_args );

if ( $related_posts ) : ?>

	<div class="section-inner wide">

		<div class="related-posts">

			<h3 class="related-posts-title"><?php _e( 'Related Posts', 'mcluhan' ); ?></h3>

			<?php

			foreach ( $related_posts as $post ) {
				setup_postdata( $post );

				if ( has_post_thumbnail() ) {
					$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'mcluhan_preview-image' );
					$image_style_attribute = ' style="background-image: url( ' . $image[0] . ');"';
				} else {
					$image_style_attribute = '';
				}

				?>

				<a <?php post_class( 'related-post' ); ?> id="post-<?php the_ID(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<div class="bg-image related-post-image"<?php echo $image_style_attribute; ?>>
						<?php if ( isset( $image ) ) : ?>
							<img src="<?php echo esc_url( $image[0] ); ?>" />
						<?php endif; ?>
					</div>
					<?php the_title( '<h2 class="title"><span>', '</span></h2>' ); ?>
				</a>

				<?php
			}

			wp_reset_postdata();

			?>

		</div><!-- .related-posts -->

	</div><!-- .section-inner.wide -->

<?php endif; ?>
