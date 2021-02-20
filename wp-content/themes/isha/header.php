<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package isha
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
<?php 
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'isha' ); ?></a>
<!-- Start Header -->
<header class="header ">
	<!-- Header Inner -->
    <div class="header-inner">
		<div class="container ">
			
			<div class="row">
				<div class="col-lg-4 col-md-12 col-12 text-center align-middle">
					
					<!-- Logo -->
					<div class="logo">
						<?php 
						if(has_custom_logo()):
							the_custom_logo();
						else: 
							if (is_home() || is_front_page() || is_archive() || is_search()) :   
							?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php else: ?>
							<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
							<?php endif;?>
						
						<?php endif;?>
					</div>
					<!--/End Logo -->
					
					<?php if(get_theme_mod( 'isha_header_social_enable' ) == '1'): ?>
						<div>
							<?php isha_header_social_items(); ?>
						</div>
					<?php endif; ?>
					<?php
					$new_blog_description = get_bloginfo( 'description', 'display' );
					if ( $new_blog_description || is_customize_preview() ) : ?>
						<p class="site-description ml-1 mb-1"><?php echo $new_blog_description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
					<!-- Mobile Menu -->
					<div class="mobile-nav mt-1"></div>
					<!--/ End Mobile Menu -->
					
				</div>
				<div class="col-lg-8 col-md-12 col-12">
					<!-- Main Menu -->
					<div class="main-menu">
						<nav class="navbar navbar-expand-lg">
						<?php
						if ( has_nav_menu( 'primary' ) ) :
						wp_nav_menu( array(
							'theme_location'    => 'primary',
							'depth'             => 3,
							'menu_class'        => 'nav menu navbar-nav',
							'container_class' 	=> 'navbar-collapse',
							'container_id'		=> 'navbarSupportedContent', 
							'fallback_cb'       => 'isha_navwalker::fallback',
							'walker'            => new isha_navwalker(),
						));
						endif;
						?>
						</nav>
					</div>
					<!--/ End Main Menu -->
				</div>
				
			</div>
		</div>
    </div>
	<!--/ End Header Inner -->
</header>
<!--/ End Header -->


<?php if( ! is_home() && (!is_front_page())):?>
		<!-- Breadcrumbs -->
<?php 
$header_bg_img = get_header_image();
		if(!empty($header_bg_img)):?>
			<section class="breadcrumbs" data-stellar-background-ratio="0.65" style="background: url(<?php echo esc_url(get_header_image());?>)">
		<?php else:?>
		<section class="breadcrumbs" data-stellar-background-ratio="0.65">
		<?php endif;?>	
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="text-left">
					<?php breadcrumb_trail(); ?>
					</div>
					<?php
					if ( is_archive() ) {
						the_archive_title( '<h2 class="entry-title">', '</h2>' );
					} else if ( is_search() ) {
						echo '<h2 class="entry-title">';
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Result For: %s', 'isha' ), '<span>' . get_search_query() . '</span>' );
						echo '</h2>';
					}
					else  {
						echo '<h1 class="entry-title">';
						echo the_title() ;
						echo '</h1>';
					}?>
				</div>
				
			</div>
		</div>
		</section>
<!--/ End Breadcrumbs -->

<?php endif;?>



<div id="content" class="site-content">