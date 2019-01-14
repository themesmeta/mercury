<?php
/**
 * Displays header site branding
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
?>
<div class="site-branding container-fluid text-center">
	<div class="site-branding__top">
		<div class="site-subnavigation">
			<ul class="list-unstyled float-left text-left">
				<li class="d-inline-block pr-2">
					<a href="#">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zM7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.88-2.88 7.19-5 9.88C9.92 16.21 7 11.85 7 9z"/><circle cx="12" cy="9" r="2.5"/></svg>
						<span><?php echo esc_html( 'Danh sách cửa hàng', 'twentynineteen' ); ?></span>
					</a>
				</li>
				<li class="d-inline-block">
					<a href="#">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M11 23.59v-3.6c-5.01-.26-9-4.42-9-9.49C2 5.26 6.26 1 11.5 1S21 5.26 21 10.5c0 4.95-3.44 9.93-8.57 12.4l-1.43.69zM11.5 3C7.36 3 4 6.36 4 10.5S7.36 18 11.5 18H13v2.3c3.64-2.3 6-6.08 6-9.8C19 6.36 15.64 3 11.5 3zm-1 11.5h2v2h-2zm2-1.5h-2c0-3.25 3-3 3-5 0-1.1-.9-2-2-2s-2 .9-2 2h-2c0-2.21 1.79-4 4-4s4 1.79 4 4c0 2.5-3 2.75-3 5z"/></svg>
						<span><?php echo esc_html( 'Trợ giúp', 'twentynineteen' ); ?></span>
					</a>
				</li>
			</ul>
			<ul class="list-unstyled float-right text-right">
				<li class="d-inline-block pr-2">
					<a href="#">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M12 5.9c1.16 0 2.1.94 2.1 2.1s-.94 2.1-2.1 2.1S9.9 9.16 9.9 8s.94-2.1 2.1-2.1m0 9c2.97 0 6.1 1.46 6.1 2.1v1.1H5.9V17c0-.64 3.13-2.1 6.1-2.1M12 4C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 9c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z"/></svg>
						<span><?php echo esc_html( 'Đăng nhập', 'twentynineteen' ); ?><span>
					</a>
				</li>
				<li class="d-inline-block">
					<a href="#">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>
						<span><?php echo esc_html( '2 / 1.900.000 VND', 'twentynineteen' ); ?></span>
					</a>
				</li>
			</ul>
		</div>
		<div class="site-logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<svg version="1.1" id="site-logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="66" height="72" x="0px" y="0px" viewBox="0 0 66 72" style="enable-background:new 0 0 66 72;" xml:space="preserve">
					<g>
						<polygon points="11.1,9.9 17.3,1 15.8,1 1,14.4 30.7,47.2 	"/>
						<polygon points="55,9.9 48.7,1 50.2,1 65,14.4 35.3,47.2 	"/>
						<path d="M42.1,1H24.2L18,9.9L32.9,49L48,9.9L42.1,1z M33,30l-1.2-18.5l-8.4-1.6h19.3l-8.4,1.6L33,30z"/>
					</g>
					<g>
						<path d="M14.4,65.4l0.9-0.1c0.8-0.1,1.1-0.3,1.1-0.4V51.2h-0.5c-2.4,0.2-4,2.6-4.6,3.9l-0.2,0.3H11l0.5-4.5h13.8l0.3,4.4h-0.1
							l-0.2-0.3c-0.5-1.1-2.3-3.9-4.4-3.9h-0.6V65c0,0.2,0.1,0.2,1.3,0.3l0.7,0.1l0.1,0.1h-7.9L14.4,65.4z"/>
						<path d="M27.6,65.4l0.9-0.1c0.8-0.1,1.1-0.3,1.1-0.4V51.6c0-0.2-0.2-0.2-1.3-0.3l-0.7-0.1L27.5,51h7.9l-0.1,0.1l-0.9,0.1
							c-0.8,0.1-1.1,0.3-1.1,0.4V65c0,0.2,0.2,0.2,1.3,0.3l0.6,0.1l0.1,0.1h-7.8L27.6,65.4z"/>
						<path d="M34.1,67.9c0-0.9,0.7-1.7,1.8-1.7c1.7,0,2.3,2,1,3.2c1.8,0.2,2.5-2,2.5-5.4V51.6c0-0.2-0.1-0.2-1.3-0.3l-0.6-0.1L37.4,51
							h7.8l-0.1,0.1l-0.9,0.1c-0.8,0.1-1.1,0.3-1.1,0.4v12.1c0,1.6-3.7,6-6.6,6C35.1,69.8,34.1,69,34.1,67.9z"/>
						<path d="M47.3,65.4l0.9-0.1c0.8-0.1,1.1-0.3,1.1-0.4V51.6c0-0.2-0.2-0.2-1.3-0.3l-0.7-0.1L47.2,51h7.9L55,51.1l-0.9,0.1
							c-0.8,0.1-1.1,0.3-1.1,0.4V65c0,0.2,0.2,0.2,1.3,0.3l0.6,0.1l0.1,0.1h-7.8L47.3,65.4z"/>
					</g>
				</svg>
			</a>
		</div>
	</div>
	<div class="site-branding__bottom">
		<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
			<nav id="site-navigation" class="main-navigation navbar" aria-label="<?php esc_attr_e( 'Primary Menu', 'twentynineteen' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'container'      => '',
						'menu_class'     => 'navbar-nav w-100 d-flex flex-row justify-content-center',
					)
				);
				?>
			</nav><!-- #site-navigation -->
		<?php endif; ?>
	</div>
</div><!-- .site-branding -->
