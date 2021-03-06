<?php
/**
 * WooCommerce Compatibility File
 *
 * @package WordPress
 * @subpackage Black_Pearl
 * @since 1.0.0
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function blackpearl_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	/* add_theme_support( 'wc-product-gallery-zoom' ); */
	add_theme_support( 'wc-product-gallery-lightbox' );
	/* add_theme_support( 'wc-product-gallery-slider' ); */
}
add_action( 'after_setup_theme', 'blackpearl_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function blackpearl_woocommerce_scripts() {
	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';
	wp_add_inline_style( 'blackpearl-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'blackpearl_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

function blackpearl_woocommerce_get_image_size_gallery_thumbnail( $size ) {
	return array(
		'width'  => 192,
		'height' => 192,
		'crop'   => 1,
	);
}
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', 'blackpearl_woocommerce_get_image_size_gallery_thumbnail' );

function blackpearl_woocommerce_get_image_size_single( $size ) {
	return array(
		'width'  => 720,
		'height' => 720,
		'crop'   => 1,
	);
}
add_filter( 'woocommerce_get_image_size_single', 'blackpearl_woocommerce_get_image_size_single' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function blackpearl_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'blackpearl_woocommerce_active_body_class' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blackpearl_woocommerce_widgets_init() {

	register_sidebar(
		array(
			'name'         => __( 'Shop', 'twentynineteen' ),
			'id'           => 'sidebar-shop',
			'description'  => __( 'Add widgets here to appear in your shop sidebar.', 'twentynineteen' ),
			'before_title' => '<h3 class="widget-title">',
			'after_title'  => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Cart Left', 'twentynineteen' ),
			'id'            => 'sidebar-cart-left',
			'description'   => __( 'Add widgets here to appear in your left sidebar of cart page.', 'twentynineteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Cart Right', 'twentynineteen' ),
			'id'            => 'sidebar-cart-right',
			'description'   => __( 'Add widgets here to appear in your right sidebar of cart page.', 'twentynineteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

}
add_action( 'widgets_init', 'blackpearl_woocommerce_widgets_init' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function blackpearl_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'blackpearl_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function blackpearl_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'blackpearl_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function blackpearl_woocommerce_loop_columns() {
	return 4;
}
add_filter( 'loop_shop_columns', 'blackpearl_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function blackpearl_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 4,
		'columns'        => 4,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'blackpearl_woocommerce_related_products_args' );



if ( ! function_exists( 'blackpearl_woocommerce_filter_button' ) ) {
	/**
	 * Add custom filter button
	 *
	 * @return void
	 */
	function blackpearl_woocommerce_filter_button() {
		?>
		<div class="woocommerce-filter-button">
			<a href="#" class="d-md-none" data-toggle="modal" data-target="#products-filter">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z"/></svg>
				<span><?php echo esc_html__( 'Lọc sản phẩm', 'twentynineteen' ); ?></span>
			</a>
		</div>
		<?php
	}
}
add_action( 'woocommerce_before_shop_loop', 'blackpearl_woocommerce_filter_button', 12 );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'blackpearl_woocommerce_header_cart' ) ) {
			blackpearl_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'blackpearl_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function blackpearl_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		blackpearl_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'blackpearl_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'blackpearl_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function blackpearl_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'twentynineteen' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'twentynineteen' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'blackpearl_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function blackpearl_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php blackpearl_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

if ( ! function_exists( 'blackpearl_woocommerce_single_product_image_thumbnail_size' ) ) {
	/**
	 * Using main image size instead of thumbnail size
	 *
	 * @param string $html Default html.
	 * @param int    $attachment_id Attachment ID.
	 * @return string
	 */
	function blackpearl_woocommerce_single_product_image_thumbnail_size( $html, $attachment_id ) {
		return wc_get_gallery_image_html( $attachment_id, true );
	}
}
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'blackpearl_woocommerce_single_product_image_thumbnail_size', 10, 2 );

if ( ! function_exists( 'blackpearl_woocommerce_can_show_post_thumbnail' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return bool
	 */
	function blackpearl_woocommerce_can_show_post_thumbnail() {
		return ! is_product() && ! post_password_required() && ! is_attachment() && has_post_thumbnail();
	}
}
add_filter( 'blackpearl_can_show_post_thumbnail', 'blackpearl_woocommerce_can_show_post_thumbnail' );

if ( ! function_exists( 'blackpearl_woocommerce_cart_sidebar_left' ) ) {
	/**
	 * Display sidebar on the left of cart page.
	 *
	 * @return void
	 */
	function blackpearl_woocommerce_cart_sidebar_left() {
		?>
		<div class="woocommerce-cart-sidebar woocommerce-cart-sidebar-left">
			<?php if ( is_active_sidebar( 'sidebar-cart-left' ) ) : ?>
				<div class="widget-column">
				<?php dynamic_sidebar( 'sidebar-cart-left' ); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}
}
add_action( 'woocommerce_before_cart', 'blackpearl_woocommerce_cart_sidebar_left', 10 );
// add_action( 'woocommerce_before_checkout_form', 'blackpearl_woocommerce_cart_sidebar_left', 10 );
if ( ! function_exists( 'blackpearl_woocommerce_cart_sidebar_right' ) ) {
	/**
	 * Display sidebar on the right of cart page.
	 *
	 * @return void
	 */
	function blackpearl_woocommerce_cart_sidebar_right() {
		?>
		<div class="woocommerce-cart-sidebar woocommerce-cart-sidebar-right">
			<?php if ( is_active_sidebar( 'sidebar-cart-right' ) ) : ?>
				<div class="widget-column">
				<?php dynamic_sidebar( 'sidebar-cart-right' ); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}
}
add_action( 'woocommerce_after_cart', 'blackpearl_woocommerce_cart_sidebar_right', 20 );

if ( ! function_exists( 'blackpearl_woocommerce_cart_main_open' ) ) {
	/**
	 * Opening .woocommerce-cart-main.
	 *
	 * @return void
	 */
	function blackpearl_woocommerce_cart_main_open() {
		$cls = is_cart() ? 'cart' : 'checkout';
		?>
		<div class="woocommerce-<?php echo esc_html( $cls ); ?>-main">
		<?php
	}
}
add_action( 'woocommerce_before_cart', 'blackpearl_woocommerce_cart_main_open', 90 );
// add_action( 'woocommerce_before_checkout_form', 'blackpearl_woocommerce_cart_main_open', 90 );
if ( ! function_exists( 'blackpearl_woocommerce_cart_main_close' ) ) {
	/**
	 * Closing .woocommerce-cart-main.
	 *
	 * @return void
	 */
	function blackpearl_woocommerce_cart_main_close() {
		?>
		</div><!-- .woocommerce-cart-main -->
		<?php
	}
}
add_action( 'woocommerce_after_cart', 'blackpearl_woocommerce_cart_main_close', 10 );
// add_action( 'woocommerce_after_checkout_form', 'blackpearl_woocommerce_cart_main_close', 10 );
if ( ! function_exists( 'blackpearl_woocommerce_order_review_wrapper_open' ) ) {
	/**
	 * Opening .woocommerce-checkout-review-order-wrapper
	 *
	 * @return void
	 */
	function blackpearl_woocommerce_order_review_wrapper_open() {
		?>
		<div class="woocommerce-checkout-review-order-wrapper">
		<?php
	}
}
add_action( 'woocommerce_checkout_before_order_review', 'blackpearl_woocommerce_order_review_wrapper_open', 10 );

if ( ! function_exists( 'blackpearl_woocommerce_order_review_wrapper_close' ) ) {
	/**
	 * Closing .woocommerce-checkout-review-order-wrapper
	 *
	 * @return void
	 */
	function blackpearl_woocommerce_order_review_wrapper_close() {
		?>
		</div>
		<?php
	}
}
add_action( 'woocommerce_checkout_after_order_review', 'blackpearl_woocommerce_order_review_wrapper_close', 10 );

if ( ! function_exists( 'blackpearl_woocommerce_cart_item_remove_link' ) ) {
	/**
	 * Cart item remove link using text instead of html special character.
	 *
	 * @return string
	 */
	function blackpearl_woocommerce_cart_item_remove_link( $html, $cart_item_key ) {
		return str_replace( '&times;', esc_html__( 'Xóa', 'twentynineteen' ), $html );
	}
}
add_filter( 'woocommerce_cart_item_remove_link', 'blackpearl_woocommerce_cart_item_remove_link', 10, 2 );

/**
 * Hide shipping rates when free shipping is available.
 * Updated to support WooCommerce 2.6 Shipping Zones.
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 */
function black_pearl_hide_shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'black_pearl_hide_shipping_when_free_is_available', 100 );
