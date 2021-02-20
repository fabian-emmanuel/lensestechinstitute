<?php
/**
 * This file includes all functions containing Theme Template.
 *
 * @package bizbuzz
 * @since 1.0.0
 */

 $options = bizbuzz_get_option();

/**
 * Template hooks.
 */



add_action( 'bizbuzz_action_doctype', 'bizbuzz_doctype' );
add_action( 'bizbuzz_action_head', 'bizbuzz_head' );

if ( isset( $options['enable_loader'] ) && $options['enable_loader'] ) {
	add_action( 'bizbuzz_action_before_start', 'bizbuzz_loader' );
}
if ( isset( $options['back_to_top'] ) && $options['back_to_top'] ) {
	add_action( 'bizbuzz_action_before_start', 'bizbuzz_back_to_top' );
}
add_action( 'bizbuzz_action_before_start', 'bizbuzz_page_wrapper_start' );
add_action( 'bizbuzz_action_before_start', 'bizbuzz_screen_reader_text' );

add_action( 'bizbuzz_action_before_header', 'bizbuzz_top_section', 10 );
add_action( 'bizbuzz_action_before_header', 'bizbuzz_header_wrapper_start', 20 );
add_action( 'bizbuzz_action_header', 'bizbuzz_header' );
add_action( 'bizbuzz_action_after_header', 'bizbuzz_header_wrapper_end' );

add_action( 'bizbuzz_action_before_content', 'bizbuzz_main_slider', 10 );
add_action( 'bizbuzz_action_before_content', 'bizbuzz_get_breadcrumb', 20 );
add_action( 'bizbuzz_action_before_content', 'bizbuzz_main_content_start', 40 );
add_action( 'bizbuzz_action_after_content', 'bizbuzz_main_content_ends', 100 );

add_action( 'bizbuzz_action_posts_navigation', 'bizbuzz_posts_navigation' );

// Front page sections.
add_action( 'bizbuzz_action_front_page', 'bizbuzz_homepage_content_about_us', 10 );
add_action( 'bizbuzz_action_front_page', 'bizbuzz_homepage_content_featured_posts', 20 );
add_action( 'bizbuzz_action_front_page', 'bizbuzz_homepage_content_cta', 30 );
add_action( 'bizbuzz_action_front_page', 'bizbuzz_homepage_content_latest_blog', 40 );
add_action( 'bizbuzz_action_front_page', 'bizbuzz_homepage_content_instagram', 50 );

/**
 * Hook Callback Functions.
 */
if ( ! function_exists( 'bizbuzz_doctype' ) ) {
	/**
	 * Doctype Declearation.
	 *
	 * @since 1.0.0
	 */
	function bizbuzz_doctype() {
		?><!doctype html><html <?php language_attributes(); ?>>
		<?php
	}
}

if ( ! function_exists( 'bizbuzz_head' ) ) {
	/**
	 * Header Declearation.
	 *
	 * @since 1.0.0
	 */
	function bizbuzz_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php
	}
}

if ( ! function_exists( 'bizbuzz_loader' ) ) {
	/**
	 * Loader.
	 *
	 * @since 1.0.0
	 */
	function bizbuzz_loader() {
		?>
		<div id="loader">
			<div class="loader-container">
				<svg xmlns="http://www.w3.org/2000/svg" width="40" height="50" viewBox="0 0 135 140" fill="#168686" style="&#10;">
					<rect y="16.4002" width="15" height="107.2" rx="6">
						<animate attributeName="height" begin="0.5s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"/>
						<animate attributeName="y" begin="0.5s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"/>
					</rect>
					<rect x="30" y="28.9002" width="15" height="82.1996" rx="6">
						<animate attributeName="height" begin="0.25s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"/>
						<animate attributeName="y" begin="0.25s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"/>
					</rect>
					<rect x="60" width="15" height="57.1996" rx="6" y="41.4002">
						<animate attributeName="height" begin="0s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"/>
						<animate attributeName="y" begin="0s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"/>
					</rect>
					<rect x="90" y="28.9002" width="15" height="82.1996" rx="6">
						<animate attributeName="height" begin="0.25s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"/>
						<animate attributeName="y" begin="0.25s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"/>
					</rect>
					<rect x="120" y="16.4002" width="15" height="107.2" rx="6">
						<animate attributeName="height" begin="0.5s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"/>
						<animate attributeName="y" begin="0.5s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"/>
					</rect>
				</svg>
			</div>
		</div><!-- #loader -->
		<?php
	}
}

if ( ! function_exists( 'bizbuzz_back_to_top' ) ) {
	/**
	 * Loader.
	 *
	 * @since 1.0.0
	 */
	function bizbuzz_back_to_top() {
		?>
		<a href="#" class="back-to-top"><i class="fas fa-chevron-up"></i></a>
		<?php
	}
}

if ( ! function_exists( 'bizbuzz_page_wrapper_start' ) ) {
	/**
	 * Page Wrapper Start.
	 *
	 * @since 1.0.0
	 */
	function bizbuzz_page_wrapper_start() {
		?>
		<div class="site" id="page">
		<?php
	}
}

if ( ! function_exists( 'bizbuzz_screen_reader_text' ) ) {
	/**
	 * Screen reader text.
	 *
	 * @since 1.0.0
	 */
	function bizbuzz_screen_reader_text() {
		?>
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'bizbuzz' ); ?></a>
		<?php
	}
}

if ( ! function_exists( 'bizbuzz_header_wrapper_start' ) ) {
	/**
	 * Header wrapper start.
	 *
	 * @since 1.0.0
	 */
	function bizbuzz_header_wrapper_start() {
		?>
		<header id="masthead" class="site-header" >
		<?php
	}
}

if ( ! function_exists( 'bizbuzz_top_section' ) ) {
	/**
	 * Top content.
	 *
	 * @since 1.0.0
	 */
	function bizbuzz_top_section() {
		$enable = bizbuzz_get_option( 'enable_topbar' );
		if ( $enable ) :
			$contact_number = bizbuzz_get_option( 'contact_number' );
			$contact_email  = bizbuzz_get_option( 'contact_email' );
			?>
			<section id="top-bar" class="" >
				<button class="topbar-toggle"><i class="fas fa-phone"></i></button>
				<div class="rt-wrapper">

					<div class="address-block-container clearfix">
						<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'topleft',
								'menu_id'         => 'top-left',
								'fallback_cb'     => false,
								'depth'           => 1,
								'menu_class'      => 'top-left',
								'container_class' => 'top-left-container',
								'fallback_cb'     => 'bizbuzz_menu_fallback_cb',
							)
						);
						?>
					</div><!-- end .address-block-container -->
						
					<div class="top-right-menu-wrapper">
						<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'social',
								'menu_id'         => 'social-menu',
								'link_before'     => '<span class="screen-reader-text">',
								'link_after'      => '</span>',
								'fallback_cb'     => false,
								'depth'           => 1,
								'menu_class'      => 'social-menu',
								'container_class' => 'social-menu-container clearfix',
								'fallback_cb'     => 'bizbuzz_menu_fallback_cb',
							)
						);

						if ( bizbuzz_has_woocommerce() ) {
							?>
							<ul class="top-card-info float-lg-right clearfix">
								<li><a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart"><i class="fas fa-shopping-basket"></i><span class="cart-num"><?php echo absint( WC()->cart->get_cart_contents_count() ); ?></span></a></li>
							</ul>
							<?php
						}
						?>
					</div>

				</div><!-- end .container -->
			</section><!-- #top-bar -->
			<?php
		endif;
	}
}

if ( ! function_exists( 'bizbuzz_header' ) ) {
	/**
	 * Header section.
	 *
	 * @since 1.0.0
	 */
	function bizbuzz_header() {

		$args    = array( 'show_title', 'show_tagline' );
		$options = bizbuzz_get_option( $args );

		$show_title   = $options['show_title'];
		$show_tagline = $options['show_tagline'];

		?>
		<section id="rt-header" class="">
			<div class="rt-wrapper">
				<div class="site-branding">
					<div class="site-logo">
						<?php bizbuzz_custom_logo(); ?>
					</div>

					<?php if ( true === $show_title || true === $show_tagline ) : ?>
						<div class="site-branding-text">
							<?php if ( true === $show_title ) : ?>
								<?php if ( is_front_page() && is_home() ) : ?>
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php else : ?>
									<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
								<?php endif; ?>
							<?php endif; ?>

							<?php if ( true === $show_tagline ) : ?>
								<p class="site-description"><?php bloginfo( 'description' ); ?></p>
							<?php endif; ?>
						</div><!-- #site-identity -->
					<?php endif; ?>
				</div>
				<div class="site-header-menu" id="site-header-menu">
					<button class="menu-toggle" aria-controls="primary-menu" area-label="<?php esc_attr_e( 'Menu', 'bizbuzz' ); ?>" aria-hidden="true" aria-expanded="false">
						<span class="icon"></span>
						<span class="menu-label"><?php esc_html_e( 'Menu', 'bizbuzz' ); ?></span>
					</button>
						<?php
							wp_nav_menu(
								array(
									'container'       => 'nav',
									'container_class' => 'main-navigation',
									'container_id'    => 'site-navigation',
									'menu_class'      => 'menu nav-menu',
									'menu_id'         => 'primary-menu',
									'theme_location'  => 'primary',
									'fallback_cb'     => 'bizbuzz_menu_fallback_cb',
								)
							);
						?>
				</div>
			</div>
		</section>
	   
		<?php
	}
}

if ( ! function_exists( 'bizbuzz_header_wrapper_end' ) ) {
	/**
	 * Header wrapper end.
	 *
	 * @since 1.0.0
	 */
	function bizbuzz_header_wrapper_end() {
		?>
		</header>
		<?php
	}
}
if ( ! function_exists( 'bizbuzz_main_content_start' ) ) :
	/**
	 *  Main Content Start.
	 *
	 * @since 1.0.0
	 */
	function bizbuzz_main_content_start() {
		?>
	<div id="content" class="site-content">
		<?php
	}
endif;
if ( ! function_exists( 'bizbuzz_main_content_ends' ) ) :
	/**
	 *  Main Content Ends.
	 *
	 * @since 1.0.0
	 */
	function bizbuzz_main_content_ends() {
		?>
		</div><!-- #content -->
		<?php
	}
endif;



if ( ! function_exists( 'bizbuzz_main_slider' ) ) {
	/**
	 *  Header image / Slider.
	 *
	 * @since 1.0.0
	 */
	function bizbuzz_main_slider() {
		$args    = array(
			'enable_slider',
			'slider_type',
			'number_of_slider',
			'header_image_as_slider',
			'hide_header_image',
			'hide_post_author',
			'hide_post_date',
			'readmore_text',
		);
		$options = bizbuzz_get_option( $args );

		$enable_slider          = $options['enable_slider'];
		$header_image_as_slider = $options['header_image_as_slider'];
		$hide_header_image      = $options['hide_header_image'];
		$readmore_text          = $options['readmore_text'];
		$display_slider         = false;
		// Front page.
		if ( is_home() || is_front_page() ) {
			if ( $enable_slider ) {
				$display_slider = true;
			}
		} else { // Other Pages.
			if ( $header_image_as_slider && ! $hide_header_image ) {
				$display_slider = false;
			}
		}

		if ( $display_slider ) {
			$slider_type      = $options['slider_type'];
			$number_of_slider = absint( $options['number_of_slider'] );

			// Getting Slider Ids.
			$slider_args = array();
			if ( $number_of_slider > 0 ) :
				for ( $i = 1; $i <= $number_of_slider; $i++ ) {
					$slider_args[] = sprintf( '%s_%d', $slider_type, $i );
				}
			endif;
			$sliders = bizbuzz_get_option( $slider_args );
			// End of getting Slider Ids.
			if ( $number_of_slider > 0 ) :
				?>
				<div id="custom-header-media" class="relative">
					
					<div class="rt-slider-wrapper bizbuzz-main-slider">
							
						<?php
						$post_ids = array();

						$has_slider_count = 0;

						foreach ( $sliders as $slider_id ) {
							if ( ! empty( $slider_id ) ) {
								$post_ids[] = $slider_id;
								$has_slider_count++;
							}
						}

						if ( ! $has_slider_count ) { // use default image if none of post have selected.
							?>
							<div class="slide-item" style="background-image:url('<?php echo esc_url( bizbuzz_get_header_image( true ) ); ?>')" >
								<div class="rt-overlay"></div>
								<?php if ( is_home() || is_front_page() ) : ?>
									<div class="rt-wrapper">
										<div class="slider-caption">
											<header class="entry-header">
												<h2 class="entry-title align-center">
													<?php bizbuzz_header_title(); ?>
												</h2>
											</header><!-- .entry-header -->
										</div>
									</div><!-- .wrapper -->							
								<?php endif; ?>
								
							</div>
							<?php
						} else {
							$post_type = ( 'page_slider' === $slider_type ) ? 'page' : 'post';

							$slider_args = array(
								'post_type'           => $post_type,
								'post__in'            => $post_ids,
								'posts_per_page'      => 3,
								'orderby'             => 'post__in',
								'ignore_sticky_posts' => 1,
							);

							$slider_post_query = new WP_Query( $slider_args );
							if ( $slider_post_query->have_posts() ) :
								while ( $slider_post_query->have_posts() ) :
									$slider_post_query->the_post();
									?>
									<div class="slide-item" style="background-image:url('<?php echo esc_url( bizbuzz_get_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>')" >
										<div class="rt-overlay"></div>
										<div class="rt-wrapper" >
											<div class="slider-caption">
												<header class="entry-header" >
													<h2 class="entry-title  animated fadeInDown" style="animation-delay: 0s;  animation-duration: 1s;"  ><a href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_title( get_the_ID() ) ); ?></a></h2>
												</header><!-- .entry-header -->
												
												<span class="entry-meta animated fadeInUp" style="animation-delay: 0.5s;  animation-duration: 1s;">
													<?php the_excerpt(); ?>
												</span>
												<div class="read-more  animated fadeInUp" style="animation-delay: 1s;  animation-duration: 1.2s;" >
													<a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php echo esc_html( $readmore_text ); ?></a>
												</div><!-- .read-more -->
											</div>
										</div><!-- .wrapper -->
									</div>
									<?php
								endwhile;
								wp_reset_postdata();
							endif;
						}
						?>
					</div>
				</div>
				<?php
			endif;
			$slider_options = array( 'autoplay' => 'false' );
			$slider_options = apply_filters( 'bizbuzz_slick_slider_options', $slider_options );
			foreach ( $slider_options as $k => $v ) {
				$option = sprintf( '%s:%s,', $k, $v );
			}
			$option = rtrim( $option, ',' );
			?>

			<script>
				jQuery(document).ready(function($) {
					$( '.bizbuzz-main-slider' ).slick( {<?php echo esc_attr( $option ); ?> });
				});
			</script>
			<?php
		} else {
			global $post;
			$url = is_home() || is_front_page() ? bizbuzz_get_header_image( true, '' ) : bizbuzz_get_post_thumbnail_url( $post->ID, 'full' );
			$url = apply_filters( 'bizbuzz_filter_header_image_url', $url,  $post->ID );
			?>
			<div id="custom-header-media" class="relative">
				<div class="rt-slider-wrapper">
					<?php if ( $url ) : ?>
					<div class="slide-item" style="background-image:url('<?php echo esc_url( $url ); ?>')" >
					<?php else : ?>
						<div class="slide-item">
					<?php endif; ?>
						<div class="rt-overlay"></div>
						<div class="rt-wrapper">
							<header class="entry-header">
								<h2 class="entry-title">
									<?php bizbuzz_header_title(); ?>
								</h2>
							</header><!-- .entry-header -->
						</div>
					</div>
				</div>
			</div>
			<?php
		}

	}
}

if ( ! function_exists( 'bizbuzz_get_breadcrumb' ) ) {
	/**
	 *  Header image / Slider.
	 *
	 * @since 1.0.0
	 */
	function bizbuzz_get_breadcrumb() {

		$enable_breadcrumb = bizbuzz_get_option( 'enable_breadcrumb' );
		if ( $enable_breadcrumb ) {
			$args = array(
				'separator'    => '>',
				'show_current' => 1,
				'show_on_home' => 0,
			);
			if ( is_home() || is_front_page() ) {

				if ( $args['show_on_home'] ) {
					?>
					<div id="bizbuzz-breadcrumb">
						<div class="rt-wrapper">
							<?php bizbuzz_default_breadcrumb( $args ); ?>
						</div>
					</div>
					<?php
				}
			} else {
				?>
				<div id="bizbuzz-breadcrumb">
					<div class="rt-wrapper">
						<?php bizbuzz_default_breadcrumb( $args ); ?>
					</div>
				</div>
				<?php
			}
		}

	}
}

if ( ! function_exists( 'bizbuzz_posts_navigation' ) ) :

	/**
	 * Posts navigation
	 *
	 * @since bizbuzz 1.0
	 */
	function bizbuzz_posts_navigation() {
		the_posts_pagination();

	}
endif;

// Home page sections.
if ( ! function_exists( 'bizbuzz_homepage_content_about_us' ) ) {

	// About Section.
	function bizbuzz_homepage_content_about_us() {
		$args    = array(
			'enable_about_us',
			'about_us_page',
			'readmore_text',
			'about_us_title',
			'about_us_content'
		);
		$options = bizbuzz_get_option( $args );

		if ( ! $options['enable_about_us'] ) {
			return;
		}
		$about_us_page = $options['about_us_page']; // Page id for about us page.
		$readmore_text = $options['readmore_text'];

		if ( $about_us_page ) :
			$about_args = array(
				'post_type'           => 'page',
				'page_id'             => $about_us_page,
				'ignore_sticky_posts' => 1,
			);
			$about_us   = new WP_Query( $about_args );
			if ( $about_us->have_posts() ) :
				while ( $about_us->have_posts() ) :
					$about_us->the_post();
					?>
					<section id="about-us" class="bizbuzz-section relative">
						<div class="rt-wrapper">
							<article class="has-featured-image">
								<div class="featured-post-image">
										<div class="rt-featured-image">
											<img src="<?php echo esc_url( bizbuzz_get_post_thumbnail_url( $about_us_page, 'full' ) ); ?>" alt="about-us">
										</div>
									</div><!-- .featured-image -->
							
									<div class="entry-container">
										<div class="section-header">
											<h2 class="section-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
										</div><!-- .section-header -->
							
										<div class="entry-content">
											<?php the_excerpt(); ?> 
										</div><!-- .entry-content -->
							
										<div class="read-more">
											<a href="<?php echo esc_url( the_permalink() ); ?>" class="btn btn-primary"><?php echo esc_html( $readmore_text ); ?></a>
										</div><!-- .read-more -->
									</div><!-- .entry-container -->
							</article>
						</div>
					</section>
					<?php
				endwhile;
				wp_reset_postdata();
			endif;
		else :
			?>
			<section id="about-us" class="bizbuzz-section relative">
				<div class="rt-wrapper">
					<article class="has-featured-image">
						<div class="featured-post-image">
								<div class="rt-featured-image">
									<img src="<?php echo esc_url( bizbuzz_get_default_thumbnail( true ) ); ?>" alt="about-us">
								</div>
							</div><!-- .featured-image -->
					
							<div class="entry-container">
								<div class="section-header">
									<h2 class="section-title"><a href="#"><?php echo esc_html( $options['about_us_title'] ); ?></a></h2>
								</div><!-- .section-header -->
					
								<div class="entry-content">
									<?php echo wp_kses( $options['about_us_content'], array( 'div', 'p' ) ); ?> 
								</div><!-- .entry-content -->
					
								<div class="read-more">
									<a href="#" class="btn btn-primary"><?php echo esc_html( $readmore_text ); ?></a>
								</div><!-- .read-more -->
							</div><!-- .entry-container -->
					</article>
				</div>
			</section>
			<?php
		endif;

	}
}

if ( ! function_exists( 'bizbuzz_homepage_content_latest_blog' ) ) {
	/**
	 * Services Section.
	 *
	 * @since 1.0.0
	 */
	function bizbuzz_homepage_content_latest_blog() {
		$args    = array(
			'enable_blog',
			'blog_title',
			'blog_subtitle',
			'hide_blog_content',
			'readmore_text',
			'hide_post_featured_image',
			'hide_post_author',
			'hide_post_date',
			'hide_post_category',
		);
		$options = bizbuzz_get_option( $args );

		$enable_blog = $options['enable_blog'];

		if ( $enable_blog ) {
			$blog_title    = $options['blog_title'];
			$blog_subtitle = $options['blog_subtitle'];
			$readmore_text = $options['readmore_text'];
			?>
			<section class="bizbuzz-section latest-blog">
				<div class="rt-wrapper">
					<?php if ( ! empty( $blog_title ) && ! empty( $blog_subtitle ) ) : ?>
						<div class="section-header">
														<?php if ( ! empty( $blog_title ) ) : ?>
								<h2 class="section-title"><?php echo esc_html( $blog_title ); ?></h2>
							<?php endif; ?>
														<?php if ( ! empty( $blog_subtitle ) ) : ?>
								<h5 class="section-subtitle"><?php echo esc_html( $blog_subtitle ); ?></h5>
							<?php endif; ?>
						</div><!-- .section-header -->
					<?php endif; ?>

					<div class="section-content">
						<?php
						$query_args           = array(
							'posts_per_page' => 6,
							'no_found_rows'  => true,
							'post_type'      => 'post',
						);
						$homepage_latest_blog = new WP_Query( $query_args );
						if ( $homepage_latest_blog->have_posts() ) :
							while ( $homepage_latest_blog->have_posts() ) :
								$homepage_latest_blog->the_post();
								?>
								<article id="latest-post-<?php echo esc_attr( get_the_ID() ); ?>" class="hentry">
									<div class="rt-overlay"></div>
									<div class="rt-featured-image">
										<?php
										if ( ! $options['hide_post_featured_image'] ) {
											bizbuzz_post_thumbnail( 'bizbuzz-thumbnail' );
										}
										?>
										<div class="rt-overlay"></div>
										<div class="read-more">
											<a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php echo esc_html( $readmore_text ); ?></a>
										</div><!-- .read-more -->
									</div><!-- .featured-image -->

									<div class="entry-container">
										<span class="entry-meta">
											<?php
											if ( ! $options['hide_post_category'] ) {
												bizbuzz_post_category();
											}
											?>
										</span>

										<header class="entry-header">
											<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
										</header>
										
										<?php if ( ! $options['hide_blog_content'] ) : ?>
											<div class="entry-content">
												<?php the_excerpt(); ?>
											</div><!-- .entry-content -->
										<?php endif; ?>
										<div class="entry-footer">
											<?php if ( ! $options['hide_post_author'] ) : ?>
												<?php bizbuzz_posted_by( 18 ); ?>
											<?php endif; ?>
											<?php bizbuzz_post_comment(); ?>
											<div class="entry-footer-posted-on">
												<?php
												if ( ! $options['hide_post_date'] ) {
													bizbuzz_posted_on();
												}
												?>
											</div>
										</div><!-- .entry-footer -->
										
									</div><!-- .entry-container -->
								</article>
								<?php
							endwhile;
							wp_reset_postdata();
						endif;
						?>
					</div><!-- .section-content -->

					<div class="section-separator"></div>
				</div><!-- .blog-posts-wrapper -->
			</section><!-- #latest-posts -->
			<?php

		}
	}
}

if ( ! function_exists( 'bizbuzz_homepage_content_cta' ) ) {
	/**
	 * Services Section.
	 *
	 * @since 1.0.0
	 */
	function bizbuzz_homepage_content_cta() {
		$args    = array(

			'enable_cta',
			'cta_title',
			'cta_description',
			'cta_button_text',
			'cta_button_link',
			'cta_background',
			'readmore_text',
		);
		$options = bizbuzz_get_option( $args );

		if ( $options['enable_cta'] ) {

			$cta_title       = $options['cta_title'];
			$cta_description = $options['cta_description'];
			$cta_button_text = $options['cta_button_text'];
			$cta_button_link = $options['cta_button_link'];

			$cta_image = get_template_directory_uri() . '/assets/images/default.jpg';
			if ( ! empty( $options['cta_background'] ) ) {
				$cta_image = $options['cta_background'];

			}
			?>
			<section id="call-to-action" class="bizbuzz-section relative" style="background-image: url( <?php echo esc_url( $cta_image ); ?> )">
				<div class="rt-overlay"></div>
				<div class="rt-wrapper relative">

					<?php if ( ! empty( $cta_title ) ) : ?>
						<div class="section-header">
							<h2 class="section-title"><?php echo esc_html( $cta_title ); ?></h2>
						</div><!-- .section-header -->
					<?php endif; ?>

									<?php if ( ! empty( $cta_description ) ) : ?>
						<div class="section-content">
																		<?php echo esc_html( $cta_description ); ?>
						</div><!-- .section-content -->
					<?php endif; ?>

					<div class="read-more">
						<a href="<?php echo esc_url( $cta_button_link ); ?>" class="btn btn-transparent"><?php echo esc_html( $cta_button_text ); ?></a>
					</div><!-- .read-more -->
				</div><!-- .wrapper -->
			</section><!-- #call-to-action -->
											<?php
		}
	}
}

if ( ! function_exists( 'bizbuzz_homepage_content_featured_posts' ) ) {
	/**
	 * Services Section.
	 *
	 * @since 1.0.0
	 */
	function bizbuzz_homepage_content_featured_posts() {
		$args    = array(
			'enable_featured_post',
			'readmore_text',
			'featured_post_1',
			'featured_post_2',
			'featured_post_3',
		);
		$options = bizbuzz_get_option( $args );

		$enable_featured_post = $options['enable_featured_post'];
		if ( $enable_featured_post ) {

			$featured_posts = bizbuzz_get_homepage_featured_post();
			if ( is_array( $featured_posts ) && count( $featured_posts ) > 0 ) :
				$thumbnail_url = isset( $featured_post['thumbnail_url'] ) && ! empty( $featured_post['thumbnail_url'] ) ? $featured_post['thumbnail_url'] : sprintf( '%s/assets/images/default.jpg', get_template_directory_uri() );
				?>
				<section id="featured-posts" class="bizbuzz-section relative">
					<div class="rt-wrapper featured-post-content">
						<?php foreach ( $featured_posts as $k => $featured_post ) : ?>
							<!-- <div class="featured-post-content"> -->
								<article style="background-image:url('<?php echo esc_url( $thumbnail_url ); ?>')">
									<div class="rt-overlay"> </div>

										<div class="section-body">
											<h3>
												<a href="<?php echo esc_url( $featured_post['link'] ); ?>" target="_self">
															<?php echo $featured_post['title']; // phpcs:ignore ?>
												</a>
											</h3>
											<p><?php echo $featured_post['content']; // phpcs:ignore ?></p>
										</div>
								</article>
							<!-- </div> -->
						<?php endforeach; ?>
					</div>
				</section>

												<?php
											endif;
		}

	}
}

if ( ! function_exists( 'bizbuzz_homepage_content_instagram' ) ) {
	/**
	 * Instagram Feed.
	 *
	 * @since 1.0.0
	 */
	function bizbuzz_homepage_content_instagram() {
		if ( shortcode_exists( 'instagram-feed' ) ) {

			?>
			<section>
				<?php echo do_shortcode( '[instagram-feed]' ); ?>
			</section>
											<?php
		}
	}
}
