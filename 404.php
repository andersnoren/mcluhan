<?php get_header(); ?>

<div class="section-inner">

	<header class="page-header section-inner">

		<h4 class="page-subtitle"><?php _e( 'Error 404', 'mcluhan' ); ?></h4>
		<h1 class="page-title"><?php _e( 'Page Not Found', 'mcluhan' ); ?></h1>

	</header><!-- .page-header -->

	<div class="section-inner">

		<?php /* Translators: %s = link to the start page */ ?>
		<p class="excerpt"><?php printf( _x( "It might have been renamed, deleted, or didn't exist in the first place. You can return to the %s or search for the content through the form below.", 'Translators: %s = link to the start page', 'mcluhan' ), '<a href="' . esc_url( home_url() ) . '">' . __( 'start page', 'mcluhan' ) . '</a>' ); ?></p>

		<?php get_search_form(); ?>

	</div>

</div> <!-- .post -->

<?php get_footer(); ?>
