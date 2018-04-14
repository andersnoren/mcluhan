<?php get_header(); ?>

<div class="section-inner">

	<?php if ( is_home() && get_theme_mod( 'mcluhan_home_title' ) ) : ?>

		<header class="page-header">
			<div>
				<h4 class="page-subtitle"><?php _e( 'Introduction', 'mcluhan' ); ?></h4>
				<h2 class="page-title"><?php echo esc_html( get_theme_mod( 'mcluhan_home_title' ) ); ?></h2>
			</div>
		</header>

	<?php elseif ( is_archive() ) : ?>

		<header class="page-header">
			<div>
				<?php if ( mcluhan_get_archive_type() ) : ?>
					<h4 class="page-subtitle"><?php mcluhan_the_archive_type(); ?></h4>
				<?php endif; ?>
				<h2 class="page-title"><?php the_archive_title(); ?></h2>
				<?php the_archive_description(); ?>
			</div>
		</header>

	<?php elseif ( is_search() && have_posts() ) :

		global $found_posts;

		?>

		<header class="page-header">
			<div>
				<h4 class="page-subtitle"><?php _e( 'Search Results', 'mcluhan' ); ?></h4>
				<h2 class="page-title"><?php echo '&ldquo;' . get_search_query() . '&rdquo;'; ?></h2>
				<?php /* Translators: %s = the number of search results */ ?>
				<p><?php printf( _x( 'We found %s matching your search query.', 'Translators: %s = the number of search results', 'mcluhan' ), $wp_query->found_posts . ' ' . ( 1 == $wp_query->found_posts ? __( 'result', 'mcluhan' ) : __( 'results', 'mcluhan' ) ) ); ?></p>
			</div>
		</header>

	<?php elseif ( is_search() ) : ?>

		<div class="section-inner">

			<header class="page-header">
				<h4 class="page-subtitle"><?php _e( 'Search Results', 'mcluhan' ); ?></h4>
				<h2 class="page-title"><?php echo '&ldquo;' . get_search_query() . '&rdquo;'; ?></h2>
				<?php /* Translators: %s = the search query */ ?>
				<p><?php printf( _x( 'We could not find any results for the search query "%s". You can try again through the form below.', 'Translators: %s = the search query', 'mcluhan' ), get_search_query() ); ?></p>
			</header>

			<?php get_search_form(); ?>

		</div>

		<?php
	endif;

	if ( have_posts() ) :

		$old_year = '1'; ?>

		<div class="posts" id="posts">

			<?php while ( have_posts() ) : the_post();

				// Get the date of the current post
				$current_year = get_the_date( 'Y' );

				// If it's different than the old year, we need a new wrapper
				if ( $current_year != $old_year ) :

					// If it's a proper year, and not the year one we added as a default before the loop, we have an open wrapper that needs closing
					if ( 1 != $old_year ) {
						echo '</ul><!-- /' . $old_year . '-->';
					}

					// Wrap the new year
					echo '<ul>';

					if ( ! is_date() ) :

						?>

						<li>
							<h3 class="list-title"><a href="<?php echo esc_url( get_year_link( $current_year ) ); ?>"><?php echo $current_year; ?></a></h3>
						</li>

						<?php

					endif;

					// Update the old_year variable
					$old_year = $current_year;

				endif;

				get_template_part( 'content', get_post_type() );

			endwhile; ?>

		</div><!-- .posts -->

	<?php endif; ?>

</div><!-- .section-inner -->

<?php

get_template_part( 'pagination' );

get_footer(); ?>
