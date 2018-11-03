<?php

$extra_classes = '';

if ( ! get_the_title() ) {
	$extra_classes = ' no-title';
}

?>

<li <?php post_class( 'post-preview' . $extra_classes ); ?> id="post-<?php the_ID(); ?>">

	<?php

	$title_args = array();

	if ( is_sticky() ) {
		$title_args = array(
			'before' => __( 'Sticky post:', 'mcluhan' ) . ' ',
		);
	}

	?>

	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( $title_args ); ?>">
		<?php
		$sticky = is_sticky() ? '<div class="sticky-arrow"></div>'  : '';
		the_title( '<h2 class="title">' . $sticky . '<span>', '</span></h2>' );

		// Check setting for the order of month and day
		$format_setting = get_theme_mod( 'mcluhan_preview_date_format' );
		$date_format = ( $format_setting && 'month-day' == $format_setting ) ? 'M j' : 'j M';

		$date = date_i18n( $date_format, get_the_time( 'U' ) );

		// Check setting for outputting date in lowercase
		if ( get_theme_mod( 'mcluhan_preview_date_lowercase' ) ) {
			$date = strtolower( $date );
		}

		// Output date
		echo '<time>' . $date . '</time>';

		?>
	</a>

</li>
