<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo $unique_id; ?>">
		<span class="screen-reader-text"><?php _e( 'Search for:', 'mcluhan' ); ?></span>
	</label>
	<input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="<?php esc_attr_e( 'Enter your search query',  'mcluhan' ); ?>" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" />
	</button>
</form>
