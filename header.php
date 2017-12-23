<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>
		
		<meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ); ?>" charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
        
        <link rel="profile" href="http://gmpg.org/xfn/11">
		 
		<?php wp_head(); ?>
	
	</head>
	
	<body <?php body_class(); ?>>
    
        <header class="site-header group">
		
			<?php if ( is_singular() ) : ?>

            	<h1 class="site-title"><a href="<?php echo esc_url( home_url() ); ?>" class="site-name"><?php bloginfo( 'name' ); ?></a></h1>
			
			<?php else : ?>
			
				<h2 class="site-title"><a href="<?php echo esc_url( home_url() ); ?>" class="site-name"><?php bloginfo( 'name' ); ?></a></h2>
			
			<?php endif; ?>

			<?php if ( get_bloginfo( 'description' ) ) : ?>

				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			
			<?php endif; ?>
			
			<div class="nav-toggle">
				<div class="bar"></div>
				<div class="bar"></div>
			</div>

			<div class="menu-wrapper">
			
				<ul class="main-menu desktop">

					<?php 

					if ( has_nav_menu( 'main-menu' ) ) {

						$main_menu_args = array( 
							'container' 		=> '',
							'items_wrap' 		=> '%3$s',
							'theme_location' 	=> 'main-menu',
						);

						wp_nav_menu( $main_menu_args ); 

					} else {

						$fallback_args = array(
							'container' => '',
							'title_li' 	=> ''
						);

						wp_list_pages( $fallback_args );
					}
					?>
				</ul>
			
			</div><!-- .menu-wrapper -->

			<?php if ( has_nav_menu( 'social-menu' ) || ( ! get_theme_mod( 'mcluhan_hide_social' ) || is_customize_preview() ) ) : ?>
			
				<ul class="social-menu desktop">

					<li><a href="<?php echo esc_url( home_url( '?s=' ) ); ?>"></a></li>
							
					<?php 

					$social_args = array(
						'theme_location'	=>	'social-menu',
						'container'			=>	'',
						'container_class'	=>	'menu-social group',
						'items_wrap'		=>	'%3$s',
						'menu_id'			=>	'menu-social-items',
						'menu_class'		=>	'menu-items',
						'depth'				=>	1,
						'link_before'		=>	'<span class="screen-reader-text">',
						'link_after'		=>	'</span>',
						'fallback_cb'		=>	'',
					);

					wp_nav_menu( $social_args );

					?>
					
				</ul><!-- .social-menu -->
			
			<?php endif; ?>

		</header><!-- header -->
		
		<div class="mobile-menu-wrapper">

			<ul class="main-menu mobile">
				<?php 
				if ( has_nav_menu( 'main-menu' ) ) {
					wp_nav_menu( $main_menu_args ); 
				} else {
					wp_list_pages( $fallback_args );
				}
				?>
				<li class="toggle-mobile-search-wrapper"><a href="#" class="toggle-mobile-search"><?php _e( 'Search', 'mcluhan' ); ?></a></li>
			</ul>

			<?php if ( has_nav_menu( 'social-menu' ) && ( ! get_theme_mod( 'mcluhan_hide_social' ) || is_customize_preview() ) ) : ?>
			
				<ul class="social-menu mobile">
							
					<?php wp_nav_menu( $social_args ); ?>
					
				</ul><!-- .social-menu -->
			
			<?php endif; ?>

		</div><!-- .mobile-menu-wrapper -->

		<div class="mobile-search">

			<div class="untoggle-mobile-search"></div>

			<?php get_search_form(); ?>

			<div class="mobile-results">

				<div class="results-wrapper"></div>

			</div>
		
		</div><!-- .mobile-search -->

		<div class="search-overlay">

			<?php get_search_form(); ?>

		</div><!-- .search-overlay -->

		<main class="site-content">