<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer py-lg-6 py-md-4 py-sm-2">
		<div class="site-info container">
			<a class="site-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>,
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentynineteen' ) ); ?>" class="imprint">
				<?php /* translators: %s: WordPress */ ?>
				<?php printf( __( 'Proudly powered by %s', 'twentynineteen' ), 'WordPress' ); ?>.
			</a>
			<?php
			if ( function_exists( 'the_privacy_policy_link' ) ) {
				the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
			}
			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

</div><!-- #page -->
<div id="mobile-menu" class="modal fade drawer drawer-left" tabindex="-1" role="dialog" aria-labelledby="mobileMenuModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="modal-close">
					<a href="javascript:void(0);" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><?php echo __( 'Đóng', 'twentynineteen' ); ?></span>
					</a>
				</div>
				<?php
				if ( has_nav_menu( 'menu-1' ) ) :
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'container'      => '',
							'menu_class'     => 'nav flex-column',
						)
					);
				endif;
				?>
			</div>
		</div>
	</div>
</div>
<?php if ( class_exists( 'WooCommerce' ) ) : ?>

<div id="products-filter" class="modal fade drawer drawer-left" tabindex="-1" role="dialog" aria-labelledby="productsFilterModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="modal-close">
					<a href="javascript:void(0);" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><?php echo __( 'Đóng', 'twentynineteen' ); ?></span>
					</a>
				</div>
				<?php if ( is_active_sidebar( 'sidebar-shop' ) ) : ?>
					<div class="widget-column">
					<?php dynamic_sidebar( 'sidebar-shop' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<div id="mini-cart" class="modal fade drawer" tabindex="-1" role="dialog" aria-labelledby="minicartModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="modal-close">
					<a href="javascript:void(0);" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><?php echo __( 'Đóng', 'twentynineteen' ); ?></span>
					</a>
				</div>
				<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
			</div>
		</div>
	</div>
</div>

<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
