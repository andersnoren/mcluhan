<?php if ( get_the_posts_pagination() ) : ?>

	<div class="archive-pagination section-inner group">
	
		<?php if ( get_previous_posts_link() ) : ?>
			<div class="previous-posts-link">
				<h4 class="title"><?php previous_posts_link( __( 'Newer', 'mcluhan' ) ); ?></h4>
			</div>
		<?php endif; ?>
		
		<?php if ( get_next_posts_link() ) : ?>
			<div class="next-posts-link">
				<h4 class="title"><?php next_posts_link( __( 'Older', 'mcluhan' ) ); ?></h4>
			</div>
		<?php endif; ?>

	</div> <!-- .pagination -->

<?php endif; ?>
