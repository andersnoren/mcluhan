<?php

/* Template Name: Categories & Tags Template */
/* Template Post Type: post, page */

get_header(); ?>

<div class="section-inner">

		<header class="page-header">

				<?php
				the_title( '<h1 class="entry-title">', '</h1>' );

				// Make sure we have a custom excerpt
				if ( has_excerpt() ) {
					echo '<p class="excerpt">' . get_the_excerpt() . '</p>';
				}

				// Only output post meta data on single
				if ( is_single() || is_attachment() ) : ?>

				<?php endif; ?>


		</header><!-- .page-header -->

	<div class="entry-content section-inner">
				<?php the_content(); ?>

			<hr>

			<h2>Categories</h2>

			<div class="tags_grid">

			    <?php
			    $categories = get_categories();
			    if ($categories) :
			        $count = 1;
			        foreach ($categories as $category) : ?>
			            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="tag-cloud-link tag-link-<?php echo esc_attr($category->term_id); ?> tag-link-position-<?php echo esc_attr($count); ?>">
			                <?php echo esc_html($category->name); ?><span class="tagcount"><?php echo esc_html($category->count); ?></span>
			            </a>
			            <?php $count++;
			        endforeach;
			    endif;
			    ?>

			</div><!-- .categories -->

			<hr>

			<h2>Tags</h2>
			
			<div class="tags_grid">
			    <?php
			    $tags = get_tags();
			    if ($tags) :
			        $count = 1;
			        foreach ($tags as $tag) : ?>
			            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="tag-cloud-link tag-link-<?php echo esc_attr($tag->term_id); ?> tag-link-position-<?php echo esc_attr($count); ?>">
			                <?php echo esc_html($tag->name); ?><span class="tagcount"><?php echo esc_html($tag->count); ?></span>
			            </a>
			            <?php $count++;
			        endforeach;
			    endif;
			    ?>

			</div> <!-- .tags -->

	</div> <!-- .content -->

</div><!-- .section-inner -->

<?php

get_footer(); ?>
