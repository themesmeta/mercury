<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
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
function twentynineteen_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-lightbox' );
}
add_action( 'after_setup_theme', 'twentynineteen_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function twentynineteen_woocommerce_scripts() {
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

	wp_add_inline_style( 'twentynineteen-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'twentynineteen_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function twentynineteen_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'twentynineteen_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function twentynineteen_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'twentynineteen_woocommerce_products_per_page' );

add_filter(
	'woocommerce_get_image_size_gallery_thumbnail',
	function ( $size ) {
		return array(
			'width'  => 96,
			'height' => 144,
			'crop'   => 1,
		);
	}
);
add_filter(
	'woocommerce_get_image_size_single',
	function( $size ) {
	return array(
		'width'  => 720,
		'height' => 1080,
		'crop'   => 1,
	);
}
	);

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function twentynineteen_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'twentynineteen_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function twentynineteen_woocommerce_loop_columns() {
	return 4;
}
add_filter( 'loop_shop_columns', 'twentynineteen_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function twentynineteen_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'twentynineteen_woocommerce_related_products_args' );

// Remove demo store
remove_action( 'wp_footer', 'woocommerce_demo_store' );

add_action(
	'woocommerce_before_shop_loop',
	function() {
	echo '<div class="woocommerce-before-shop-loop__filter col">
		<a href="#" class="btn">' . __( 'Filter', 'twentynineteen' ) . '
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
				<g id="Bounding_Boxes">
				<g id="ui_x5F_spec_x5F_header_copy_3" display="none">
				</g>
				<path fill="none" d="M0,0h24v24H0V0z"/>
				</g>
				<g id="Outline">
				<g id="ui_x5F_spec_x5F_header" display="none">
				</g>
				<path d="M10,18h4v-2h-4V18z M3,6v2h18V6H3z M6,13h12v-2H6V13z"/>
				</g>
			</svg>
		</a>
	</div>';
},
	15
	);

function twentynineteen_action_woocommerce_before_shop_loop() {
	return '<div class="woocommerce-before-shop-loop row">';
}
add_action( 'woocommerce_before_shop_loop', 'twentynineteen_action_woocommerce_before_shop_loop', 5 );

function twentynineteen_action_woocommerce_before_shop_loop_close_div() {
	return '</div>';
}
add_action( 'woocommerce_before_shop_loop', 'twentynineteen_action_woocommerce_before_shop_loop_close_div', 35 );

add_action(
	'woocommerce_before_shop_loop',
	function() {
	echo '<div class="woocommerce-before-shop-loop__result-count col">';
},
	19
	);
add_action(
	'woocommerce_before_shop_loop',
	function() {
	echo '</div>';
},
	21
	);

add_action(
	'woocommerce_before_shop_loop',
	function() {
	echo '<div class="woocommerce-before-shop-loop__ordering col">';
},
	29
	);
add_action(
	'woocommerce_before_shop_loop',
	function() {
	echo '</div>';
},
	31
	);

add_action(
	'woocommerce_before_single_product',
	function() {
	echo '<div class="container-fluid">';
},
	20
	);
add_action(
	'woocommerce_after_single_product',
	function() {
	echo '</div>';
},
	10
	);

if ( ! function_exists( 'twentynineteen_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function twentynineteen_woocommerce_product_columns_wrapper() {
		$columns = twentynineteen_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'twentynineteen_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'twentynineteen_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function twentynineteen_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'twentynineteen_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'twentynineteen_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function twentynineteen_woocommerce_wrapper_before() {
		?>
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'twentynineteen_woocommerce_wrapper_before' );

if ( ! function_exists( 'twentynineteen_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function twentynineteen_woocommerce_wrapper_after() {
			?>
			<?php
	}
}
add_action( 'woocommerce_after_main_content', 'twentynineteen_woocommerce_wrapper_after' );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 15 );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'twentynineteen_woocommerce_header_cart' ) ) {
			twentynineteen_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'twentynineteen_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function twentynineteen_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		twentynineteen_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'twentynineteen_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'twentynineteen_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function twentynineteen_woocommerce_cart_link() {
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

if ( ! function_exists( 'twentynineteen_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function twentynineteen_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php twentynineteen_woocommerce_cart_link(); ?>
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

if ( ! function_exists( 'filter_woocommerce_cart_item_remove_link' ) ) {
	function filter_woocommerce_cart_item_remove_link( $cart_item_remove_link, $cart_item_key ) {
		$cart_item             = WC()->cart->cart_contents[ $cart_item_key ];
		$_product              = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		$product_id            = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
		$cart_item_remove_link = sprintf(
			'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">%s</a>',
			esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
			__( 'Remove this item', 'woocommerce' ),
			esc_attr( $product_id ),
			esc_attr( $cart_item_key ),
			esc_attr( $_product->get_sku() ),
			__( 'Remove', 'woocommerce' )
		);
		return $cart_item_remove_link;
	}
}
add_filter( 'woocommerce_cart_item_remove_link', 'filter_woocommerce_cart_item_remove_link', 10, 2 );

function _filter_woocommerce_breadcrumb_defaults( $defaults ) {
	$defaults['delimiter'] = '  &nbsp;&rsaquo;&nbsp;  ';
	return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', '_filter_woocommerce_breadcrumb_defaults' );
