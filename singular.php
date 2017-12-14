<?php 

get_header();

if ( have_posts() )  : 

	while ( have_posts() ) : the_post(); ?>

		<article <?php post_class(); ?>>

			<?php if ( has_post_thumbnail() ) : ?>

				<div class="featured-image">
					<?php the_post_thumbnail( 'mcluhan_fullscreen-image' ); ?>
				</div>

			<?php endif; ?>
		
			<header class="entry-header section-inner">
			
				<?php 
				the_title( '<h1 class="entry-title">', '</h2>' );

				// Make sure we have a custom excerpt
				if ( has_excerpt() ) {
					echo '<p class="excerpt">' . get_the_excerpt() . '</p>';
				}

				// Only output post meta data on single
				if ( is_single() || is_attachment() ) : ?>

					<div class="meta">

						<time><a href="<?php the_permalink(); ?>" title="<?php the_time( get_option( 'date_format' ) ); ?> <?php the_time( get_option( 'time_format' ) ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></time>

						<?php if ( ! is_attachment() ) : ?>

							<span><?php echo __( 'In', 'mcluhan' ) . ' '; the_category( ', ' ); ?></span>

						<?php endif; ?>

					</div>

				<?php endif; ?>
			
			</header><!-- .entry-header -->

			<div class="entry-content section-inner">

				<?php the_content(); ?>

			</div> <!-- .content -->

			<?php 
			
			wp_link_pages( array(
				'before' => '<p class="section-inner linked-pages">' . __( 'Pages', 'mcluhan' ) . ':',
			) ); 
			
			if ( get_post_type() == 'post' && get_the_tags() ) : ?>

				<div class="meta bottom section-inner">
				
					<p class="tags"><?php the_tags( ' #', ' #', ' ' ); ?></p>

				</div> <!-- .meta -->

				<?php 
			endif;

			// Check for single post pagination
			if ( is_single() && ! is_attachment() && ( get_previous_post_link() || get_next_post_link() ) ) : ?>
			
				<div class="post-pagination section-inner">
			
					<div class="previous-post">
						<?php if ( get_previous_post_link() ) : ?>
							<?php echo get_previous_post_link( '%link', '<span>%title</span>' ); ?>
						<?php endif; ?>
					</div>
			
					<div class="next-post">
						<?php if ( get_next_post_link() ) : ?>
							<?php echo get_next_post_link( '%link', '<span>%title</span>' ); ?>
						<?php endif; ?>
					</div>
			
				</div><!-- .post-pagination -->
			
			<?php endif;
			
			// If comments are open, or there are at least one comment
			if ( get_comments_number() || comments_open() ) : ?>
			
				<div class="section-inner wide">
					<?php comments_template(); ?>
				</div>
			
			<?php endif; ?>

		</div> <!-- .post -->

		<?php 
		
		if ( get_post_type() == 'post' ) get_template_part( 'related-posts' );

	endwhile;

endif; 

get_footer(); ?>