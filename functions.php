<?php

/* THEME SETUP
------------------------------------------------ */

function mcluhan_setup() {
	
	// Automatic feed
	add_theme_support( 'automatic-feed-links' );
	
	// Set content-width
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 560;
	
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
add_action( 'after_setup_theme', 'mcluhan_setup' );



/* IN SEARCH, LIST RESULTS BY DATE
------------------------------------------------ */

function mcluhan_sort_search_posts_by_date( $query ) {
	if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
		$query->set( 'orderby', 'date' );
	}
}
add_action( 'pre_get_posts', 'mcluhan_sort_search_posts_by_date' );



/* ENQUEUE STYLES
------------------------------------------------ */

function mcluhan_load_style() {
	if ( ! is_admin() ) {
		wp_register_style( 'mcluhan-fonts', 'https://fonts.googleapis.com/css?family=Archivo:400,400i,600,600i,700,700i&amp;subset=latin-ext', array(), null );
		wp_register_style( 'fontawesome', get_template_directory_uri() . '/assets/css/font-awesome.css', null );

		wp_enqueue_style( 'mcluhan-style', get_template_directory_uri() . '/style.css', array( 'fontawesome', 'mcluhan-fonts' ) );
    } 
}
add_action( 'wp_enqueue_scripts', 'mcluhan_load_style' );



/* ADD EDITOR STYLES
------------------------------------------------ */

function mcluhan_add_editor_styles() {
    add_editor_style( array( 
		'mcluhan-editor-styles.css', 
		'https://fonts.googleapis.com/css?family=Archivo:400,400i,600,700,700i&amp;subset=latin-ext' 
	) );
}
add_action( 'init', 'mcluhan_add_editor_styles' );



/* DEACTIVATE DEFAULT WP GALLERY STYLES
------------------------------------------------ */

add_filter( 'use_default_gallery_style', '__return_false' );



/* ENQUEUE SCRIPTS
------------------------------------------------ */

function mcluhan_enqueue_scripts() {
	wp_enqueue_script( 'mcluhan_global', get_template_directory_uri() . '/assets/js/global.js', array( 'jquery', 'imagesloaded', 'masonry' ), '', true );

	global $wp_query;

	// AJAX PAGINATION
    wp_localize_script( 'mcluhan_global', 'mcluhan_ajaxpagination', array(
        'ajaxurl'		=> admin_url( 'admin-ajax.php' ),
        'query_vars'	=> json_encode( $wp_query->query )
    ) );
}

add_action( 'wp_enqueue_scripts', 'mcluhan_enqueue_scripts' );



/* POST CLASSES
------------------------------------------------ */

function mcluhan_post_classes( $classes ) {

	// Class indicating presence/lack of post thumbnail
	$classes[] = ( has_post_thumbnail() ? 'has-thumbnail' : 'missing-thumbnail' );
	
	return $classes;
}
add_action( 'post_class', 'mcluhan_post_classes' );



/* BODY CLASSES
------------------------------------------------ */

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
add_action( 'body_class', 'mcluhan_body_classes' );



/* MODIFY HTML CLASS TO INDICATE JS
------------------------------------------------ */

function mcluhan_has_js() { 
	?>
	<script>jQuery( 'html' ).removeClass( 'no-js' ).addClass( 'js' );</script>
	<?php
}
add_action( 'wp_head', 'mcluhan_has_js' );



/* ENQUEUE COMMENT-REPLY.JS
------------------------------------------------ */

function mcluhan_load_scripts(){
    if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'mcluhan_load_scripts' );



/* GET AND OUTPUT ARCHIVE TYPE
------------------------------------------------ */

/* GET THE TYPE */

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
    } else {
        $type = __( 'Archives', 'mcluhan' );
    }
    return $type;
}

/* OUTPUT THE TYPE */

function mcluhan_the_archive_type() {
	$type = mcluhan_get_archive_type();

	echo $type;
}



/* ---------------------------------------------------------------------------------------------
   AJAX PAGINATION
   This function is called to load the next set of posts
   --------------------------------------------------------------------------------------------- */


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
				while ( $ajax_query->have_posts() ) : $ajax_query->the_post();

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

		}

	endif; // if string

	die();
}
add_action( 'wp_ajax_nopriv_ajax_pagination', 'mcluhan_ajax_results' );
add_action( 'wp_ajax_ajax_pagination', 'mcluhan_ajax_results' );



/* REMOVE PREFIX BEFORE ARCHIVE TITLES
------------------------------------------------ */

function mcluhan_remove_archive_title_prefix( $title ) {
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
    } else {
        $title = __( 'Archives', 'mcluhan' );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'mcluhan_remove_archive_title_prefix' );



/* CUSTOM COMMENT OUTPUT
------------------------------------------------ */
if ( ! function_exists( 'mcluhan_comment' ) ) {

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

								<?php if ( $comment->user_id === $post->post_author ) echo '<span class="comment-by-post-author"> (' . __( 'Author', 'mcluhan' ) . ')</span>'; ?>
							</span>

							<span class="comment-date">
								<a class="comment-date-link" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>" title="<?php echo get_comment_date() . ' ' . __( 'at', 'mcluhan' ) .' ' . get_comment_time(); ?>"><?php echo get_comment_date( get_option( 'date_format' ) ); ?></a>
							</span>
							
							<?php
							comment_reply_link( array( 
								'after'			=>		'</span>',
								'before'		=>		'<span class="comment-reply">',
								'depth'			=> 		$depth, 
								'max_depth' 	=> 		$args['max_depth'],
								'reply_text' 	=>  	__( 'Reply', 'mcluhan' ),
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
}



/* ADMIN NOTICES
------------------------------------------------ */

function mcluhan_admin_notices() {

	// Show notice about posts per page on theme activation, if the setting isn't set already
	if ( isset( $_GET['activated'] ) && $_GET['activated'] == true && get_option( 'template' ) == 'mcluhan' && get_option( 'posts_per_page' ) < 999 ) : ?>

		<div class="notice notice-info is-dismissible">
			<p><?php printf( __( 'To make McLuhan display like the %sdemo site%s, with all posts listed on archive pages, you need to change the "Blog pages show at most" setting in %sSettings > Reading%s to a value exceeding the number of posts on your site.', 'mcluhan' ), '<a href="http://www.andersnoren.se/themes/mcluhan/">', '</a>', '<a href="' . admin_url( 'options-reading.php' ) . '">', '</a>' ); ?></p>
		</div>

		<?php 
	endif;

}
add_action( 'mcluhan_admin_notices', 'showAdminMessages' );



/* CUSTOMIZER SETTINGS
------------------------------------------------ */

class mcluhan_customize {

	public static function mcluhan_register( $wp_customize ) {


		// Add our Customizer section
		$wp_customize->add_section( 'mcluhan_options', array(
			'capability' 	=> 'edit_theme_options',
			'description' 	=> __( 'Customize the theme settings for McLuhan.', 'mcluhan' ),
			'title' 		=> __( 'Theme Options', 'mcluhan' ),
			'priority' 		=> 35,
		) );
		
		
		// Custom accent color
		$wp_customize->add_setting( 'mcluhan_accent_color', array(
			'default' 			=> '#121212',
			'transport' 		=> 'postMessage',
			'type' 				=> 'theme_mod',
			'sanitize_callback' => 'sanitize_hex_color'
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mcluhan_accent_color', array(
			'description' 	=> 	__( 'Set the background color used for the sidebar on desktop, and the header on tablet and mobile.', 'mcluhan' ),
			'label' 		=> 	__( 'Sidebar background', 'mcluhan' ),
			'section' 		=> 'colors',
			'settings' 		=> 'mcluhan_accent_color',
			'priority' 		=> 10,
		) ) );


		// Dark sidebar text
		$wp_customize->add_setting( 'mcluhan_dark_sidebar_text', array(
			'capability' 		=> 'edit_theme_options',
			'sanitize_callback' => 'mcluhan_sanitize_checkbox',
			'transport'			=> 'postMessage'
		) );

		$wp_customize->add_control( 'mcluhan_dark_sidebar_text', array(
			'description' 	=> __( 'Check this if you have set a light background color for the sidebar/mobile header.', 'mcluhan' ),
			'label' 		=> __( 'Dark text in sidebar', 'mcluhan' ),
			'section' 		=> 'colors',
			'type' 			=> 'checkbox',
			'priority' 		=> 15,
		) );

		
		// Set the home page title
		$wp_customize->add_setting( 'mcluhan_home_title', array(
			'capability' 		=> 'edit_theme_options',
			'sanitize_callback' => 'sanitize_textarea_field',
			'transport'			=> 'postMessage'
		) );

		$wp_customize->add_control( 'mcluhan_home_title', array(
			'description' 	=> __( 'The title you want shown on the page that displays your latest posts.', 'mcluhan' ),
			'label' 		=> __( 'Front Page Title', 'mcluhan' ),
			'type' 			=> 'textarea',
			'section' 		=> 'mcluhan_options',
		) );


		// Hide social 
		$wp_customize->add_setting( 'mcluhan_hide_social', array(
			'capability' 		=> 'edit_theme_options',
			'sanitize_callback' => 'mcluhan_sanitize_checkbox',
			'transport'			=> 'postMessage'
		) );

		$wp_customize->add_control( 'mcluhan_hide_social', array(
			'type' 			=> 'checkbox',
			'section' 		=> 'mcluhan_options',
			'label' 		=> __( 'Hide social buttons', 'mcluhan' ),
			'description' 	=> __( 'As default, the social section and a search toggle, even if a menu has not been set for the social section.', 'mcluhan' ),
		) );


		// Decide order of month + day in post previews
		$wp_customize->add_setting( 'mcluhan_preview_date_format', array(
			'capability' 		=> 'edit_theme_options',
			'default' 			=> 'month-day',
			'sanitize_callback' => 'mcluhan_sanitize_radio',
		) );

		$wp_customize->add_control( 'mcluhan_preview_date_format', array(
			'type' 			=> 'radio',
			'section' 		=> 'mcluhan_options',
			'label' 		=> __( 'Archive Date Format', 'mcluhan' ),
			'description' 	=> __( 'Choose whether post previews should display the date with month or day of month first.', 'mcluhan' ),
			'choices' 		=> array(
				'month-day' 	=> __( 'Month first (Jan 1)', 'mcluhan' ),
				'day-month' 	=> __( 'Day of month first (1 Jan)', 'mcluhan' )
			),
		) );


		// Lowercase calendar month
		$wp_customize->add_setting( 'mcluhan_preview_date_lowercase', array(
			'capability' 		=> 'edit_theme_options',
			'sanitize_callback' => 'mcluhan_sanitize_checkbox',
			'transport'			=> 'postMessage'
		) );

		$wp_customize->add_control( 'mcluhan_preview_date_lowercase', array(
			'label' 		=> __( 'Show the month name in lowercase', 'mcluhan' ),
			'section' 		=> 'mcluhan_options',
			'type' 			=> 'checkbox',
			'priority' 		=> 15,
		) );		

		// Make built-in controls use live JS preview
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
		
		
		// SANITATION

		// Sanitize boolean for checkbox
		function mcluhan_sanitize_checkbox( $checked ) {
			return ( ( isset( $checked ) && true == $checked ) ? true : false );
		}

		// Sanitize radio buttons
		function mcluhan_sanitize_radio( $input, $setting ) {
			
			// Ensure input is a slug.
			$input = sanitize_key( $input );

			// Get list of choices from the control associated with the setting.
			$choices = $setting->manager->get_control( $setting->id )->choices;

			// If the input is a valid key, return it; otherwise, return the default.
			return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
		}
		
	}

	// Output custom CSS in the header
	public static function mcluhan_header_output() {
		?>

		<!-- Customizer CSS --> 

		<style type="text/css">

			<?php 

			self::mcluhan_generate_css( 'body .site-header', 'background-color', 'mcluhan_accent_color' );
			self::mcluhan_generate_css( '.social-menu.desktop', 'background-color', 'mcluhan_accent_color' );
			self::mcluhan_generate_css( '.social-menu a:hover', 'color', 'mcluhan_accent_color' );
			self::mcluhan_generate_css( '.social-menu a.active', 'color', 'mcluhan_accent_color' );
			self::mcluhan_generate_css( '.mobile-menu-wrapper', 'background-color', 'mcluhan_accent_color' );
			self::mcluhan_generate_css( '.social-menu.mobile', 'background-color', 'mcluhan_accent_color' );
			self::mcluhan_generate_css( '.mobile-search.active', 'background-color', 'mcluhan_accent_color' );

			?>

		</style>
		
		<!-- /Customizer CSS -->

		<?php
	}

	// Function for generating the custom CSS
	public static function mcluhan_generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
		$return = '';
		$mod = esc_attr( get_theme_mod( $mod_name ) );
		if ( ! empty( $mod ) ) {
		   $return = sprintf('%s { %s:%s; }',
			  $selector,
			  $style,
			  $prefix.$mod.$postfix
		   );
		   if ( $echo ) {
			  echo $return;
		   }
		}
		return $return;
	  }

	// Initiate the live preview JS
	public static function mcluhan_live_preview() {
		wp_enqueue_script( 'mcluhan-themecustomizer', get_template_directory_uri() . '/assets/js/theme-customizer.js', array(  'jquery', 'customize-preview' ), '', true );
	}

}

// Output custom CSS to live site
add_action( 'wp_head' , array( 'mcluhan_customize' , 'mcluhan_header_output' ) );

// Setup the Theme Customizer settings and controls
add_action( 'customize_register', array( 'mcluhan_customize', 'mcluhan_register' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init', array( 'mcluhan_customize' , 'mcluhan_live_preview' ) );


?>