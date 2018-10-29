<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function twentynineteen_body_classes( $classes ) {

	if ( is_singular() ) {
		// Adds `singular` to singular pages.
		$classes[] = 'singular';
	} else {
		// Adds `hfeed` to non singular pages.
		$classes[] = 'hfeed';
	}

	// Adds a class if image filters are enabled.
	if ( twentynineteen_image_filters_enabled() ) {
		$classes[] = 'image-filters-enabled';
	}

	return $classes;
}
add_filter( 'body_class', 'twentynineteen_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function twentynineteen_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'twentynineteen_pingback_header' );

/**
 * Changes comment form default fields.
 */
function twentynineteen_comment_form_defaults( $defaults ) {
	$comment_field = $defaults['comment_field'];

	// Adjust height of comment form.
	$defaults['comment_field'] = preg_replace( '/rows="\d+"/', 'rows="5"', $comment_field );

	return $defaults;
}
add_filter( 'comment_form_defaults', 'twentynineteen_comment_form_defaults' );

/**
 * Filters the default archive titles.
 */
function twentynineteen_get_the_archive_title() {
	if ( is_category() ) {
		$title = esc_html__( 'Category Archives:', 'twentynineteen' );
	} elseif ( is_tag() ) {
		$title = esc_html__( 'Tag Archives:', 'twentynineteen' );
	} elseif ( is_author() ) {
		$title = esc_html__( 'Author Archives:', 'twentynineteen' );
	} elseif ( is_year() ) {
		$title = esc_html__( 'Yearly Archives:', 'twentynineteen' );
	} elseif ( is_month() ) {
		$title = esc_html__( 'Monthly Archives:', 'twentynineteen' );
	} elseif ( is_day() ) {
		$title = esc_html__( 'Daily Archives:', 'twentynineteen' );
	} elseif ( is_post_type_archive() ) {
		$title = esc_html__( 'Post Type Archives:', 'twentynineteen' );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name */
		$title = sprintf( __( '%s Archives: ' ), $tax->labels->singular_name );
	} else {
		$title = esc_html__( 'Archives:', 'twentynineteen' );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'twentynineteen_get_the_archive_title' );

/**
 * Filters the default archive descriptions.
 */
function twentynineteen_get_the_archive_description() {
	if ( is_category() || is_tag() || is_tax() ) {
		$description = single_term_title( '', false );
	} elseif ( is_author() ) {
		$description = get_the_author_meta( 'display_name' );
	} elseif ( is_post_type_archive() ) {
		$description = post_type_archive_title( '', false );
	} elseif ( is_year() ) {
		$description = get_the_date( _x( 'Y', 'yearly archives date format', 'twentynineteen' ) );
	} elseif ( is_month() ) {
		$description = get_the_date( _x( 'F Y', 'monthly archives date format', 'twentynineteen' ) );
	} elseif ( is_day() ) {
		$description = get_the_date();
	} else {
		$description = null;
	}
	return $description;
}
add_filter( 'get_the_archive_description', 'twentynineteen_get_the_archive_description' );

/**
 * Determines if post thumbnail can be displayed.
 */
function twentynineteen_can_show_post_thumbnail() {
	return apply_filters( 'twentynineteen_can_show_post_thumbnail', ! post_password_required() && ! is_attachment() && has_post_thumbnail() );
}

/**
 * Returns true if image filters are enabled on the theme options.
 */
function twentynineteen_image_filters_enabled() {
	return true;
}

/**
 * Returns the size for avatars used in the theme.
 */
function twentynineteen_get_avatar_size() {
	return 60;
}

/**
 * Returns true if comment is by author of the post.
 *
 * @see get_comment_class()
 */
function twentynineteen_is_comment_by_post_author( $comment = null ) {
	if ( is_object( $comment ) && $comment->user_id > 0 ) {
		$user = get_userdata( $comment->user_id );
		$post = get_post( $comment->comment_post_ID );
		if ( ! empty( $user ) && ! empty( $post ) ) {
			return $comment->user_id === $post->post_author;
		}
	}
	return false;
}

/**
 * Returns information about the current post's discussion, with cache support.
 */
function twentynineteen_get_discussion_data() {
	static $discussion, $post_id;
	$current_post_id = get_the_ID();
	if ( $current_post_id === $post_id ) { /* If we have discussion information for post ID, return cached object */
		return $discussion;
	}
	$authors    = array();
	$commenters = array();
	$user_id    = is_user_logged_in() ? get_current_user_id() : -1;
	$comments   = get_comments(
		array(
			'post_id' => $current_post_id,
			'orderby' => 'comment_date_gmt',
			'order'   => get_option( 'comment_order', 'asc' ), /* Respect comment order from Settings » Discussion. */
			'status'  => 'approve',
		)
	);
	foreach ( $comments as $comment ) {
		$comment_user_id = (int) $comment->user_id;
		if ( $comment_user_id !== $user_id ) {
			$authors[]    = ( $comment_user_id > 0 ) ? $comment_user_id : $comment->comment_author_email;
			$commenters[] = $comment->comment_author_email;
		}
	}
	$authors    = array_unique( $authors );
	$responses  = count( $commenters );
	$commenters = array_unique( $commenters );
	$post_id    = $current_post_id;
	$discussion = (object) array(
		'authors'    => array_slice( $authors, 0, 6 ), /* Unique authors commenting on post (a subset of), excluding current user. */
		'commenters' => count( $commenters ),          /* Number of commenters involved in discussion, excluding current user. */
		'responses'  => $responses,                    /* Number of responses, excluding responses from current user. */
	);
	return $discussion;
}

/**
 * WCAG 2.0 Attributes for Dropdown Menus
 *
 * Adjustments to menu attributes tot support WCAG 2.0 recommendations
 * for flyout and dropdown menus.
 *
 * @ref https://www.w3.org/WAI/tutorials/menus/flyout/
 */
function twentynineteen_nav_menu_link_attributes( $atts, $item, $args, $depth ) {

	// Add [aria-haspopup] and [aria-expanded] to menu items that have children
	$item_has_children = in_array( 'menu-item-has-children', $item->classes );
	if ( $item_has_children ) {
		$atts['aria-haspopup'] = 'true';
		$atts['aria-expanded'] = 'false';
	}

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'twentynineteen_nav_menu_link_attributes', 10, 4 );

/**
 * Add a dropdown icon to top-level menu items
 */
function twentynineteen_add_dropdown_icons( $output, $item, $depth, $args ) {

	// Only add class to 'top level' items on the 'primary' menu.
	if ( 'menu-1' == $args->theme_location && 0 === $depth ) {

		if ( in_array( 'menu-item-has-children', $item->classes ) ) {
			$output .= twentynineteen_get_icon_svg( 'arrow_drop_down_circle', 16 );
		}
	} elseif ( 'menu-1' == $args->theme_location && $depth >= 1 ) {

		if ( in_array( 'menu-item-has-children', $item->classes ) ) {
			$output .= twentynineteen_get_icon_svg( 'keyboard_arrow_right', 24 );
		}
	}

	return $output;
}
add_filter( 'walker_nav_menu_start_el', 'twentynineteen_add_dropdown_icons', 10, 4 );

/**
 * Add a possibility to discover fengshui
 */
function twentynineteen_ajax_fengshui_discover() {
	if ( ! empty( $_POST['date'] ) ) {
		$solar_date         = explode( '/', $_POST['date'] );
		$solar              = new Solar();
		$solar->solar_day   = $solar_date[0];
		$solar->solar_month = $solar_date[1];
		$solar->solar_year  = $solar_date[2];
		$lunar              = LunarSolarConverter::solar_to_lunar( $solar );
		$gender             = $_POST['gender'];
		$wu_xing            = twentynineteen_wu_xing_calculator( $lunar->lunar_year, $gender );

		wp_send_json_success(
			array(
				'lunar'   => $lunar,
				'wu_xing' => $wu_xing,
			)
		);
	} else {
		wp_send_json_error();
	}
}
add_action( 'wp_ajax_nopriv_twentynineteen_ajax_fengshui_discover', 'twentynineteen_ajax_fengshui_discover' );
add_action( 'wp_ajax_twentynineteen_ajax_fengshui_discover', 'twentynineteen_ajax_fengshui_discover' );

/**
 * Add a possibility to calculating "can - chi"
 */
function twentynineteen_wu_xing_calculator( $lunar_year, $gender ) {
	$can_arr         = array(
		__( 'Canh', 'twentynineteen' ),
		__( 'Tân', 'twentynineteen' ),
		__( 'Nhâm', 'twentynineteen' ),
		__( 'Quý', 'twentynineteen' ),
		__( 'Giáp', 'twentynineteen' ),
		__( 'Ất', 'twentynineteen' ),
		__( 'Bính', 'twentynineteen' ),
		__( 'Đinh', 'twentynineteen' ),
		__( 'Mậu', 'twentynineteen' ),
		__( 'Kỷ', 'twentynineteen' ),
	);
	$chi_arr         = array(
		__( 'Tý', 'twentynineteen' ),
		__( 'Sửu', 'twentynineteen' ),
		__( 'Dần', 'twentynineteen' ),
		__( 'Mão', 'twentynineteen' ),
		__( 'Thìn', 'twentynineteen' ),
		__( 'Tỵ', 'twentynineteen' ),
		__( 'Ngọ', 'twentynineteen' ),
		__( 'Mùi', 'twentynineteen' ),
		__( 'Thân', 'twentynineteen' ),
		__( 'Dậu', 'twentynineteen' ),
		__( 'Tuất', 'twentynineteen' ),
		__( 'Hợi', 'twentynineteen' ),
	);
	$wu_xing_arr     = array(
		'Giáp Tý'   => __( 'Hải trung kim', 'twentynineteen' ),
		'Ất Sửu'    => __( 'Hải trung kim', 'twentynineteen' ),
		'Bính Dần'  => __( 'Lô trung hỏa', 'twentynineteen' ),
		'Đinh Mão'  => __( 'Lô trung hỏa', 'twentynineteen' ),
		'Mậu Thìn'  => __( 'Đại lâm mộc', 'twentynineteen' ),
		'Kỷ Tỵ'     => __( 'Đại lâm mộc', 'twentynineteen' ),
		'Canh Ngọ'  => __( 'Lộ bàng thổ', 'twentynineteen' ),
		'Tân Mùi'   => __( 'Lộ bàng thổ', 'twentynineteen' ),
		'Nhâm Thân' => __( 'Kiếm phong kim', 'twentynineteen' ),
		'Quý Dậu'   => __( 'Kiếm phong kim', 'twentynineteen' ),
		'Giáp Tuất' => __( 'Sơn đầu hỏa', 'twentynineteen' ),
		'Ất Hợi'    => __( 'Sơn đầu hỏa', 'twentynineteen' ),
		'Bính Tý'   => __( 'Giản hạ thủy', 'twentynineteen' ),
		'Đinh Sửu'  => __( 'Giản hạ thủy', 'twentynineteen' ),
		'Mậu Dần'   => __( 'Thành đầu thổ', 'twentynineteen' ),
		'Kỷ Mão'    => __( 'Thành đầu thổ', 'twentynineteen' ),
		'Canh Thìn' => __( 'Bạch lạp kim', 'twentynineteen' ),
		'Tân Tỵ'    => __( 'Bạch lạp kim', 'twentynineteen' ),
		'Nhâm Ngọ'  => __( 'Dương liễu mộc', 'twentynineteen' ),
		'Quý Mùi'   => __( 'Dương liễu mộc', 'twentynineteen' ),
		'Giáp Thân' => __( 'Tuyền trung thủy', 'twentynineteen' ),
		'Ất Dậu'    => __( 'Tuyền trung thủy', 'twentynineteen' ),
		'Bính Tuất' => __( 'Ốc thượng thổ', 'twentynineteen' ),
		'Đinh Hợi'  => __( 'Ốc thượng thổ', 'twentynineteen' ),
		'Mậu Tý'    => __( 'Bích lôi hỏa', 'twentynineteen' ),
		'Kỷ Sửu'    => __( 'Bích lôi hỏa', 'twentynineteen' ),
		'Canh Dần'  => __( 'Tùng bách mộc', 'twentynineteen' ),
		'Tân Mão'   => __( 'Tùng bách mộc', 'twentynineteen' ),
		'Nhâm Thìn' => __( 'Trường lưu thủy', 'twentynineteen' ),
		'Quý Tỵ'    => __( 'Trường lưu thủy', 'twentynineteen' ),
		'Giáp Ngọ'  => __( 'Sa trung kim', 'twentynineteen' ),
		'Ất Mùi'    => __( 'Sa trung kim', 'twentynineteen' ),
		'Bính Thân' => __( 'Sơn hạ hỏa', 'twentynineteen' ),
		'Đinh Dậu'  => __( 'Sơn hạ hỏa', 'twentynineteen' ),
		'Mậu Tuất'  => __( 'Bình địa mộc', 'twentynineteen' ),
		'Kỷ Hợi'    => __( 'Bình địa mộc', 'twentynineteen' ),
		'Canh Tý'   => __( 'Bích thượng thổ', 'twentynineteen' ),
		'Tân Sửu'   => __( 'Bích thượng thổ', 'twentynineteen' ),
		'Nhâm Dần'  => __( 'Kim bạc kim', 'twentynineteen' ),
		'Quý Mão'   => __( 'Kim bạc kim', 'twentynineteen' ),
		'Giáp Thìn' => __( 'Phú đăng hỏa', 'twentynineteen' ),
		'Ất Tỵ'     => __( 'Phú đăng hỏa', 'twentynineteen' ),
		'Bính Ngọ'  => __( 'Thiên hà thủy', 'twentynineteen' ),
		'Đinh Mùi'  => __( 'Thiên hà thủy', 'twentynineteen' ),
		'Mậu Thân'  => __( 'Đại dịch thổ', 'twentynineteen' ),
		'Kỷ Dậu'    => __( 'Đại dịch thổ', 'twentynineteen' ),
		'Canh Tuất' => __( 'Thoa xuyến kim', 'twentynineteen' ),
		'Tân Hợi'   => __( 'Thoa xuyến kim', 'twentynineteen' ),
		'Nhâm Tý'   => __( 'Tang thạch mộc', 'twentynineteen' ),
		'Quý Sửu'   => __( 'Tang thạch mộc', 'twentynineteen' ),
		'Giáp Dần'  => __( 'Đại khê thủy', 'twentynineteen' ),
		'Ất Mão'    => __( 'Đại khê thủy', 'twentynineteen' ),
		'Bính Thìn' => __( 'Sa trung thổ', 'twentynineteen' ),
		'Đinh Tỵ'   => __( 'Sa trung thổ', 'twentynineteen' ),
		'Mậu Ngọ'   => __( 'Thiên thượng hỏa', 'twentynineteen' ),
		'Kỷ Mùi'    => __( 'Thiên thượng hỏa', 'twentynineteen' ),
		'Canh Thân' => __( 'Thạch Lựu mộc', 'twentynineteen' ),
		'Tân Dậu'   => __( 'Thạch Lựu mộc', 'twentynineteen' ),
		'Nhâm Tuất' => __( 'Đại hải thủy', 'twentynineteen' ),
		'Quý Hợi'   => __( 'Đại hải thủy', 'twentynineteen' ),
	);
	$male_cungmenh   = array(
		__( 'Khôn Thổ', 'twentynineteen' ),
		__( 'Khảm Thủy', 'twentynineteen' ),
		__( 'Ly Hỏa', 'twentynineteen' ),
		__( 'Cấn Thổ', 'twentynineteen' ),
		__( 'Đoài Kim', 'twentynineteen' ),
		__( 'Càn Kim', 'twentynineteen' ),
		__( 'Khôn Thổ', 'twentynineteen' ),
		__( 'Tốn Mộc', 'twentynineteen' ),
		__( 'Chấn Mộc', 'twentynineteen' ),
	);
	$female_cungmenh = array(
		__( 'Tốn Mộc', 'twentynineteen' ),
		__( 'Cấn Thổ', 'twentynineteen' ),
		__( 'Càn Kim', 'twentynineteen' ),
		__( 'Đoài Kim', 'twentynineteen' ),
		__( 'Cấn Thổ', 'twentynineteen' ),
		__( 'Ly Hỏa', 'twentynineteen' ),
		__( 'Khảm Thủy', 'twentynineteen' ),
		__( 'Khôn Thổ', 'twentynineteen' ),
		__( 'Chấn Mộc', 'twentynineteen' ),
	);
	// calculating "can"
	$tmp       = str_split( $lunar_year );
	$can_index = end( $tmp ); // int
	$can       = $can_arr[ $can_index ];
	// calculating "chi"
	$y2k = substr( $lunar_year, -2, strlen( $lunar_year ) );
	if ( $lunar_year >= 2000 ) {
		$y2k = $lunar_year - 1900;
	}
	$chi_index = $y2k % 12;
	$chi       = $chi_arr[ $chi_index ];
	// calculating "cungmenh"
	$year_total = 0;
	foreach ( $tmp as $key => $value ) {
		$year_total += $value;
	}
	$cung_menh = '';
	if ( 'male' === $gender ) {
		$cung_menh = $male_cungmenh[ $year_total % 9 ];
	} elseif ( 'female' === $gender ) {
		$cung_menh = $female_cungmenh[ $year_total % 9 ];
	}
	// return the result as string
	$output = array(
		'can_chi'   => $can . ' ' . $chi,
		'wu_xing'   => $wu_xing_arr[ $can . ' ' . $chi ],
		'cung_menh' => $cung_menh,
	);
	return $output;
}
