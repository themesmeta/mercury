<?php
/**
 * Displays header site branding
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
?>
<div class="site-branding bg-dark text-white">
	<div class="row flex-nowrap justify-content-between align-items-center text-center">
		<div class="col-4">
			<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
				<nav id="site-navigation" class="main-navigation navbar navbar-expand-lg" aria-label="<?php esc_attr_e( 'Primary Menu', 'twentynineteen' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'container'      => '',
							'menu_class'     => 'navbar-nav w-100 d-flex justify-content-between',
						)
					);
					?>
				</nav><!-- #site-navigation -->
			<?php endif; ?>
		</div>
		<div class="col-4">
			<?php if ( has_custom_logo() ) : ?>
				<div class="site-logo"><?php the_custom_logo(); ?></div>
			<?php endif; ?>

			<?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif; ?>

			<?php
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) :
				?>
					<p class="site-description">
						<?php echo $description; ?>
					</p>
			<?php endif; ?>
		</div>
		<div class="col-4">
			<?php if ( has_nav_menu( 'menu-2' ) ) : ?>
				<nav id="second-navigation" class="second-navigation navbar navbar-expand-lg" aria-label="<?php esc_attr_e( 'Secondary Menu', 'twentynineteen' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-2',
							'container'      => '',
							'menu_class'     => 'navbar-nav w-100 d-flex justify-content-between',
						)
					);
					?>
				</nav><!-- #second-navigation -->
			<?php endif; ?>
		</div>
	</div>
</div><!-- .site-branding -->
