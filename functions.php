<?php

/* THEME SETUP
------------------------------------------------ */

if ( ! function_exists( 'mcluhan_setup' ) ) {
	function mcluhan_setup() {

		// Automatic feed
		add_theme_support( 'automatic-feed-links' );

		// Set content-width
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 560;
		}

		// Post thumbnail support
		add_theme_support( 'post-thumbnails' );

		// Post thumbnail size
		set_post_thumbnail_size( 1200, 9999 );

		// Custom image sizes
		add_image_size( 'mcluhan_preview-image', 600, 9999 );

		// Background color
		add_theme_support( 'custom-background', array(
			'default-color' => 'ffffff',
		) );

		// Title tag support
		add_theme_support( 'title-tag' );

		// Add nav menu
		register_nav_menu( 'main-menu', __( 'Main menu', 'mcluhan' ) );
		register_nav_menu( 'social-menu', __( 'Social links', 'mcluhan' ) );

		// Add excerpts to pages
		add_post_type_support( 'page', array( 'excerpt' ) );

		// HTML5 semantic markup
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

		// Make the theme translation ready
		load_theme_textdomain( 'mcluhan', get_template_directory() . '/languages' );

	}
} // End if().
add_action( 'after_setup_theme', 'mcluhan_setup' );


/* INCLUDE REQUIRED FILES
------------------------------------------------ */

// Handle Customizer settings
require get_template_directory() . '/inc/classes/class-mcluhan-customize.php';


/*	-----------------------------------------------------------------------------------------------
	ENQUEUE STYLES
--------------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'mcluhan_load_style' ) ) :
	function mcluhan_load_style() {

		$dependencies = array();
		$theme_version = wp_get_theme( 'mcluhan' )->get( 'Version' );

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$google_fonts = _x( 'on', 'Google Fonts: on or off', 'mcluhan' );

		if ( 'off' !== $google_fonts ) {

			// Register Google Fonts
			wp_register_style( 'mcluhan-fonts', '//fonts.googleapis.com/css?family=Archivo:400,400i,600,600i,700,700i&amp;subset=latin-ext', false, 1.0, 'all' );
			$dependencies[] = 'mcluhan-fonts';

		}

		wp_register_style( 'fontawesome', get_template_directory_uri() . '/assets/css/font-awesome.css', null );
		$dependencies[] = 'fontawesome';

		wp_enqueue_style( 'mcluhan-style', get_template_directory_uri() . '/style.css', $dependencies, $theme_version );
	}
	add_action( 'wp_enqueue_scripts', 'mcluhan_load_style' );
endif;


/*	-----------------------------------------------------------------------------------------------
	ADD EDITOR STYLES
--------------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'mcluhan_add_editor_styles' ) ) :
	function mcluhan_add_editor_styles() {

		$editor_styles = array( 'assets/css/mcluhan-classic-editor-styles.css' );

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$google_fonts = _x( 'on', 'Google Fonts: on or off', 'mcluhan' );

		if ( 'off' !== $google_fonts ) {
			$editor_styles[] = '//fonts.googleapis.com/css?family=Archivo:400,400i,600,700,700i&amp;subset=latin-ext';
		}

		add_editor_style( $editor_styles );

	}
	add_action( 'init', 'mcluhan_add_editor_styles' );
endif;


/*	-----------------------------------------------------------------------------------------------
	DEACTIVATE DEFAULT CORE GALLERY STYLES
	Only applies to the shortcode gallery.
--------------------------------------------------------------------------------------------------- */

add_filter( 'use_default_gallery_style', '__return_false' );


/* ENQUEUE SCRIPTS
------------------------------------------------ */

if ( ! function_exists( 'mcluhan_enqueue_scripts' ) ) :
	function mcluhan_enqueue_scripts() {

		$theme_version = wp_get_theme( 'mcluhan' )->get( 'Version' );

		wp_enqueue_script( 'mcluhan_global', get_template_directory_uri() . '/assets/js/global.js', array( 'jquery', 'imagesloaded', 'masonry' ), $theme_version, true );

		// Enqueue comment reply
		if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		global $wp_query;

		// AJAX PAGINATION
		wp_localize_script( 'mcluhan_global', 'mcluhan_ajaxpagination', array(
			'ajaxurl'		=> admin_url( 'admin-ajax.php' ),
			'query_vars'	=> wp_json_encode( $wp_query->query ),
		) );

	}
	add_action( 'wp_enqueue_scripts', 'mcluhan_enqueue_scripts' );
endif;


/*	-----------------------------------------------------------------------------------------------
	FILTER POST_CLASS
--------------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'mcluhan_post_classes' ) ) {
	function mcluhan_post_classes( $classes ) {

		// Class indicating presence/lack of post thumbnail
		$classes[] = ( has_post_thumbnail() ? 'has-thumbnail' : 'missing-thumbnail' );

		// Class indicating lack of title
		if ( ! get_the_title() ) $classes[] = 'no-title';

		return $classes;
	}
}
add_action( 'post_class', 'mcluhan_post_classes' );


/*	-----------------------------------------------------------------------------------------------
	FILTER BODY_CLASS
--------------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'mcluhan_body_classes' ) ) {
	function mcluhan_body_classes( $classes ) {

		// Check whether we're in the customizer preview
		if ( is_customize_preview() ) {
			$classes[] = 'customizer-preview';
		}

		// Hide social buttons
		if ( get_theme_mod( 'mcluhan_hide_social' ) ) {
			$classes[] = 'hide-social';
		}

		// White bg class
		if ( get_theme_mod( 'mcluhan_accent_color' ) == '#ffffff' && ( ! get_background_color() || get_background_color() == 'ffffff' ) ) {
			$classes[] = 'white-bg';
		}

		// Check whether the custom backgrounds are both set to the same thing
		if ( get_theme_mod( 'mcluhan_accent_color' ) && get_background_color() && ltrim( get_theme_mod( 'mcluhan_accent_color' ), '#' ) == get_background_color() ) {
			$classes[] = 'same-custom-bgs';
		}

		// Dark sidebar text
		if ( get_theme_mod( 'mcluhan_dark_sidebar_text' ) ) {
			$classes[] = 'dark';
		}

		// Add short class for resume page template
		if ( is_page_template( 'resume-page-template.php' ) ) {
			$classes[] = 'resume-template';
		}

		// Add short class for full width page template
		if ( is_page_template( 'full-width-page-template.php' ) ) {
			$classes[] = 'full-width-template';
		}

		return $classes;
	}
} // End if().
add_action( 'body_class', 'mcluhan_body_classes' );


/*	-----------------------------------------------------------------------------------------------
	NO-JS CLASS
--------------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'mcluhan_has_js' ) ) {
	function mcluhan_has_js() {
		?>
		<script>jQuery( 'html' ).removeClass( 'no-js' ).addClass( 'js' );</script>
		<?php
	}
}
add_action( 'wp_head', 'mcluhan_has_js' );


/*	-----------------------------------------------------------------------------------------------
	AJAX SEARCH RESULTS
	This function is called to load ajax search results on mobile.
--------------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'mcluhan_ajax_results' ) ) {
	function mcluhan_ajax_results() {

		$string = json_decode( stripslashes( $_POST['query_data'] ), true );

		if ( $string ) :

			$args = array(
				's'					=> $string,
				'posts_per_page'	=> 5,
				'post_status'		=> 'publish',
			);

			$ajax_query = new WP_Query( $args );

			if ( $ajax_query->have_posts() ) {

				?>

				<p class="results-title"><?php _e( 'Search Results', 'mcluhan' ); ?></p>

				<ul>

					<?php

					// Custom loop
					while ( $ajax_query->have_posts() ) :

						$ajax_query->the_post();

						// Load the appropriate content template
						get_template_part( 'content-mobile-search' );

					// End the loop
					endwhile;

					?>

				</ul>

				<?php if ( $ajax_query->max_num_pages > 1 ) : ?>

					<a class="show-all" href="<?php echo esc_url( home_url( '?s=' . $string ) ); ?>"><?php _e( 'Show all', 'mcluhan' ); ?></a>

				<?php endif; ?>

				<?php

			} else {

				echo '<p class="no-results-message">' . __( 'We could not find anything that matches your search query. Please try again.', 'mcluhan' ) . '</p>';

			} // End if().

		endif; // End if().

		die();
	}
} // End if().
add_action( 'wp_ajax_nopriv_ajax_pagination', 'mcluhan_ajax_results' );
add_action( 'wp_ajax_ajax_pagination', 'mcluhan_ajax_results' );


/*	-----------------------------------------------------------------------------------------------
	GET AND OUTPUT ARCHIVE TYPE
--------------------------------------------------------------------------------------------------- */

/* GET THE TYPE */

if ( ! function_exists( 'mcluhan_get_archive_type' ) ) {
	function mcluhan_get_archive_type() {
		if ( is_category() ) {
			$type = __( 'Category', 'mcluhan' );
		} elseif ( is_tag() ) {
			$type = __( 'Tag', 'mcluhan' );
		} elseif ( is_author() ) {
			$type = __( 'Author', 'mcluhan' );
		} elseif ( is_year() ) {
			$type = __( 'Year', 'mcluhan' );
		} elseif ( is_month() ) {
			$type = __( 'Month', 'mcluhan' );
		} elseif ( is_day() ) {
			$type = __( 'Date', 'mcluhan' );
		} elseif ( is_post_type_archive() ) {
			$type = __( 'Post Type', 'mcluhan' );
		} elseif ( is_tax() ) {
			$term = get_queried_object();
			$taxonomy = $term->taxonomy;
			$taxonomy_labels = get_taxonomy_labels( get_taxonomy( $taxonomy ) );
			$type = $taxonomy_labels->name;
		} else if ( is_search() ) {
			$type = __( 'Search Results', 'mcluhan' );
		} else if ( is_home() && get_theme_mod( 'mcluhan_home_title' ) ) {
			$type = __( 'Introduction', 'mcluhan' );
		} else {
			$type = __( 'Archives', 'mcluhan' );
		}

		return $type;
	}
}

/* OUTPUT THE TYPE */

if ( ! function_exists( 'mcluhan_the_archive_type' ) ) {
	function mcluhan_the_archive_type() {
		$type = mcluhan_get_archive_type();

		echo $type;
	}
}


/*	-----------------------------------------------------------------------------------------------
	FILTER ARCHIVE TITLE

	@param	$title string		The initial title.
--------------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'mcluhan_remove_archive_title_prefix' ) ) :
	function mcluhan_remove_archive_title_prefix( $title ) {

		// A duplicate of the core archive title conditional, but without the prefix.
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '#', false );
		} elseif ( is_author() ) {
			$title = '<span class="vcard">' . get_the_author() . '</span>';
		} elseif ( is_year() ) {
			$title = get_the_date( 'Y' );
		} elseif ( is_month() ) {
			$title = get_the_date( 'F Y' );
		} elseif ( is_day() ) {
			$title = get_the_date( get_option( 'date_format' ) );
		} elseif ( is_tax( 'post_format' ) ) {
			if ( is_tax( 'post_format', 'post-format-aside' ) ) {
				$title = _x( 'Aside', 'post format archive title', 'mcluhan' );
			} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
				$title = _x( 'Galleries', 'post format archive title', 'mcluhan' );
			} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
				$title = _x( 'Images', 'post format archive title', 'mcluhan' );
			} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
				$title = _x( 'Videos', 'post format archive title', 'mcluhan' );
			} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
				$title = _x( 'Quotes', 'post format archive title', 'mcluhan' );
			} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
				$title = _x( 'Links', 'post format archive title', 'mcluhan' );
			} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
				$title = _x( 'Statuses', 'post format archive title', 'mcluhan' );
			} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
				$title = _x( 'Audio', 'post format archive title', 'mcluhan' );
			} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
				$title = _x( 'Chats', 'post format archive title', 'mcluhan' );
			}
		} elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		} elseif ( is_tax() ) {
			$title = single_term_title( '', false );
		} elseif ( is_home() ) {
			if ( get_theme_mod( 'mcluhan_home_title' ) ) {
				$title = get_theme_mod( 'mcluhan_home_title' );
			} elseif ( get_option( 'page_for_posts' ) ) {
				$title = get_the_title( get_option( 'page_for_posts' ) );
			} else {
				$title = '';
			}
		} elseif ( is_search() ) {
			$title = '&ldquo;' . get_search_query() . '&rdquo;';
		} else {
			$title = __( 'Archives', 'mcluhan' );
		}

		return $title;

	}
	add_filter( 'get_the_archive_title', 'mcluhan_remove_archive_title_prefix' );
endif;


/*	-----------------------------------------------------------------------------------------------
	FILTER ARCHIVE DESCRIPTION

	@param	$description string		The initial description.
--------------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'mcluhan_filter_archive_description' ) ) :
	function mcluhan_filter_archive_description( $description ) {
		
		// On search, show a string describing the results of the search.
		if ( is_search() ) {
			global $wp_query;
			if ( $wp_query->found_posts ) {
				/* Translators: %s = Number of results */
				$description = sprintf( _x( 'We found %s matching your search query.', 'Translators: %s = the number of search results', 'mcluhan' ), $wp_query->found_posts . ' ' . ( 1 == $wp_query->found_posts ? __( 'result', 'mcluhan' ) : __( 'results', 'mcluhan' ) ) );
			} else {
				/* Translators: %s = the search query */
				$description = sprintf( _x( 'We could not find any results for the search query "%s". You can try again through the form below.', 'Translators: %s = the search query', 'mcluhan' ), get_search_query() );
			}
		}

		return $description;

	}
	add_filter( 'get_the_archive_description', 'mcluhan_filter_archive_description' );
endif;


/*	-----------------------------------------------------------------------------------------------
	PRE_GET_POSTS
--------------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'mcluhan_sort_search_posts_by_date' ) ) {
	function mcluhan_sort_search_posts_by_date( $query ) {

		// In search, order results by date
		if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
			$query->set( 'orderby', 'date' );
		}

	}
}
add_action( 'pre_get_posts', 'mcluhan_sort_search_posts_by_date' );


/*	-----------------------------------------------------------------------------------------------
	CUSTOM COMMENT OUTPUT
--------------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'mcluhan_comment' ) ) :
	function mcluhan_comment( $comment, $args, $depth ) {

		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				global $post;
				?>

				<div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
					<?php _e( 'Pingback:', 'mcluhan' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'mcluhan' ) ); ?>

				<?php

				break;

			default :
				global $post;
				?>
				<div <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

					<div id="comment-<?php comment_ID(); ?>">

						<header class="comment-meta">

							<span class="comment-author">
								<cite>
									<?php echo get_comment_author_link(); ?>
								</cite>

								<?php
								if ( $comment->user_id === $post->post_author ) {
									echo '<span class="comment-by-post-author"> (' . __( 'Author', 'mcluhan' ) . ')</span>';
								}
								?>
							</span>

							<span class="comment-date">
								<a class="comment-date-link" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>" title="<?php echo get_comment_date() . ' ' . __( 'at', 'mcluhan' ) . ' ' . get_comment_time(); ?>"><?php echo get_comment_date( get_option( 'date_format' ) ); ?></a>
							</span>

							<?php
							comment_reply_link( array(
								'after'			=> '</span>',
								'before'		=> '<span class="comment-reply">',
								'depth'			=> $depth,
								'max_depth' 	=> $args['max_depth'],
								'reply_text' 	=> __( 'Reply', 'mcluhan' ),
							) );
							?>

						</header>

						<div class="comment-content entry-content">

							<?php comment_text(); ?>

						</div><!-- .comment-content -->

						<div class="comment-actions">
							<?php if ( '0' == $comment->comment_approved ) : ?>
								<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'mcluhan' ); ?></p>
							<?php endif; ?>
						</div><!-- .comment-actions -->

					</div><!-- .comment -->

			<?php
			break;
		endswitch;

	}
endif; // End if().


/*	-----------------------------------------------------------------------------------------------
	ADMIN NOTICES
--------------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'mcluhan_admin_notices' ) ) :
	function mcluhan_admin_notices() {

		// Show notice about posts per page on theme activation, if the setting isn't set already
		if ( isset( $_GET['activated'] ) && true == $_GET['activated'] && 'mcluhan' == get_option( 'template' ) && get_option( 'posts_per_page' ) < 999 ) : ?>

			<div class="notice notice-info is-dismissible">
				<?php /* Translators: %1$1s = opening link to the demo site, %2$2s = closing link tag, %3$3s = link to the reading options, %4$4s = closing link tag */ ?>
				<p><?php printf( _x( 'To make McLuhan display like the %1$1sdemo site%2$2s, with all posts listed on archive pages, you need to change the "Blog pages show at most" setting in %3$3sSettings > Reading%4$4s to a value exceeding the number of posts on your site.', 'Translators: %1$1s = opening link to the demo site, %2$2s = closing link tag, %3$3s = link to the reading options, %4$4s = closing link tag', 'mcluhan' ), '<a href="https://www.andersnoren.se/themes/mcluhan/">', '</a>', '<a href="' . admin_url( 'options-reading.php' ) . '">', '</a>' ); ?></p>
			</div>

			<?php
		endif;

	}
	add_action( 'mcluhan_admin_notices', 'showAdminMessages' );
endif;


/* ---------------------------------------------------------------------------------------------
   SPECIFY BLOCK EDITOR SUPPORT
------------------------------------------------------------------------------------------------ */

if ( ! function_exists( 'mcluhan_add_block_editor_features' ) ) :
	function mcluhan_add_block_editor_features() {

		/* Block Editor Features ------------- */

		add_theme_support( 'align-wide' );

		/* Block Editor Palette -------------- */

		add_theme_support( 'editor-color-palette', array(
			array(
				'name' 	=> _x( 'Black', 'Name of the black color in the Gutenberg palette', 'mcluhan' ),
				'slug' 	=> 'black',
				'color' => '#121212',
			),
			array(
				'name' 	=> _x( 'Dark Gray', 'Name of the dark gray color in the Gutenberg palette', 'mcluhan' ),
				'slug' 	=> 'dark-gray',
				'color' => '#333',
			),
			array(
				'name' 	=> _x( 'Medium Gray', 'Name of the medium gray color in the Gutenberg palette', 'mcluhan' ),
				'slug' 	=> 'medium-gray',
				'color' => '#555',
			),
			array(
				'name' 	=> _x( 'Light Gray', 'Name of the light gray color in the Gutenberg palette', 'mcluhan' ),
				'slug' 	=> 'light-gray',
				'color' => '#777',
			),
			array(
				'name' 	=> _x( 'White', 'Name of the white color in the Gutenberg palette', 'mcluhan' ),
				'slug' 	=> 'white',
				'color' => '#fff',
			),
		) );

		/* Block Editor Font Sizes ----------- */

		add_theme_support( 'editor-font-sizes', array(
			array(
				'name' 		=> _x( 'Small', 'Name of the small font size in Gutenberg', 'mcluhan' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the Gutenberg editor.', 'mcluhan' ),
				'size' 		=> 16,
				'slug' 		=> 'small',
			),
			array(
				'name' 		=> _x( 'Normal', 'Name of the regular font size in Gutenberg', 'mcluhan' ),
				'shortName' => _x( 'N', 'Short name of the regular font size in the Gutenberg editor.', 'mcluhan' ),
				'size' 		=> 18,
				'slug' 		=> 'normal',
			),
			array(
				'name' 		=> _x( 'Large', 'Name of the large font size in Gutenberg', 'mcluhan' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the Gutenberg editor.', 'mcluhan' ),
				'size' 		=> 24,
				'slug' 		=> 'large',
			),
			array(
				'name' 		=> _x( 'Larger', 'Name of the larger font size in Gutenberg', 'mcluhan' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the Gutenberg editor.', 'mcluhan' ),
				'size' 		=> 28,
				'slug' 		=> 'larger',
			),
		) );

	}
	add_action( 'after_setup_theme', 'mcluhan_add_block_editor_features' );
endif;


/* ---------------------------------------------------------------------------------------------
   BLOCK EDITOR STYLES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'mcluhan_block_editor_styles' ) ) :
	function mcluhan_block_editor_styles() {

		$dependencies = array();
		$theme_version = wp_get_theme( 'mcluhan' )->get( 'Version' );

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$google_fonts = _x( 'on', 'Google Fonts: on or off', 'mcluhan' );

		if ( 'off' !== $google_fonts ) {

			// Register Google Fonts
			wp_register_style( 'mcluhan-block-editor-styles-font', '//fonts.googleapis.com/css?family=Archivo:400,400i,600,600i,700,700i&amp;subset=latin-ext', false, 1.0, 'all' );
			$dependencies[] = 'mcluhan-block-editor-styles-font';

		}

		// Enqueue the editor styles
		wp_enqueue_style( 'mcluhan-block-editor-styles', get_theme_file_uri( '/assets/css/mcluhan-block-editor-styles.css' ), $dependencies, $theme_version, 'all' );

	}
	add_action( 'enqueue_block_editor_assets', 'mcluhan_block_editor_styles', 1 );
endif;

?>
