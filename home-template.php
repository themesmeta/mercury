<?php
/**
 * Template Name: Homepage
 * Template Post Type: page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="fengshui-dicover text-center py-md-8">
				<div class="container">
					<h2 class="mb-1"><?php _e( 'Phong thủy', 'twentynineteen' ); ?></h2>
					<h5><?php _e( 'Bắt đầu hành trình khám phá bản thân', 'twentynineteen' ); ?></h5>
					<div class="form-fengshui-discover row mt-lg-4 mt-md-2">
						<p class="col-6 form-row form-row-first validate-required" id="fengshui-birthday-field">
							<label for="fengshui-birthday" class=""><?php _e( 'Ngày tháng năm sinh – dương lịch', 'twentynineteen' ); ?>&nbsp;<abbr class="required" title="required">*</abbr></label>
							<input type="text" class="" name="fengshui-birthday" id="fengshui-birthday" placeholder="" value="">
						</p>
						<p class="col-6 form-row form-row-last validate-required" id="fengshui-gender-field">
							<label for="fengshui-gender" class=""><?php _e( 'Giới tính', 'twentynineteen' ); ?>&nbsp;<abbr class="required" title="required">*</abbr></label>
							<select type="text" class="form-control" name="fengshui-gender" id="fengshui-gender">
								<option value="male"><?php _e( 'Nam', 'twentynineteen' ); ?></option>
								<option value="female"><?php _e( 'Nữ', 'twentynineteen' ); ?></option>
							</select>
						</p>
						<p class="col-12 form-row form-row-wide">
							<a href="javascript:void(0);" class="btn btn-dark" id="btn-fengshui-discover"><?php _e( 'Xem ngay', 'twentynineteen' ); ?></a>
						</p>
					</div>
				</div>
			</div>
			<div id="fengshui-display" class="fengshui-display text-center section-close">
				<div class="container py-lg-6 py-md-4 py-sm-2">
					<h3 class="mb-2"><?php _e( 'Phong thủy của bạn', 'twentynineteen' ); ?></h3>
					<p class="mb-0"><?php _e( 'Dương lịch', 'twentynineteen' ); ?>: <span class="solar-date"><?php _e( 'unknown', 'twentynineteen' ); ?></span> – <?php _e( 'Âm lịch', 'twentynineteen' ); ?>: <span class="lunar-date"><?php _e( 'unknown', 'twentynineteen' ); ?></span> ( <span class="can-chi"><?php _e( 'unknown', 'twentynineteen' ); ?></span> )</p>
					<p><?php _e( 'Giới tính', 'twentynineteen' ); ?>: <span class="gender"><?php _e( 'unknown', 'twentynineteen' ); ?></span> – <?php _e( 'Sinh mệnh', 'twentynineteen' ); ?>: <span class="wu-xing"><?php _e( 'unknown', 'twentynineteen' ); ?></span> – <?php _e( 'Cung mệnh', 'twentynineteen' ); ?>: <span class="cung-menh"><?php _e( 'unknown', 'twentynineteen' ); ?></span></p>
					<h4 class="mt-lg-6 mb-lg-4 my-md-3"><?php _e( 'Màu sắc phong thủy với cung mệnh', 'twentynineteen' ); ?> <span class="cung-menh"><?php _e( 'unknown', 'twentynineteen' ); ?></span></h4>
					<div id="fengshui-display-color" class="row fengshui-display-color">
						<div class="col-md-3 tuong-sinh">
							<h5><?php _e( 'Tương sinh', 'twentynineteen' ); ?></h5>
							<div class="row">
								<div class="col-6">
									<span class="fengshui-color-swatch" data-color="black"></span>
									<small class="text-uppercase"><?php _e( 'Đen', 'twentynineteen' ); ?></small>
								</div>
								<div class="col-6">
									<span class="fengshui-color-swatch" data-color="blue"></span>
									<small class="text-uppercase"><?php _e( 'Xanh biển', 'twentynineteen' ); ?></small>
								</div>
							</div>
						</div>
						<div class="col-md-3 tuong-hop">
							<h5><?php _e( 'Tương hợp', 'twentynineteen' ); ?></h5>
							<div class="row">
								<div class="col-6">
									<span class="fengshui-color-swatch" data-color="green"></span>
									<small class="text-uppercase"><?php _e( 'Xanh lá', 'twentynineteen' ); ?></small>
								</div>
							</div>
						</div>
						<div class="col-md-3 che-khac">
							<h5><?php _e( 'Chế khắc', 'twentynineteen' ); ?></h5>
							<div class="row">
								<div class="col-6">
									<span class="fengshui-color-swatch" data-color="yellow"></span>
									<small class="text-uppercase"><?php _e( 'Vàng', 'twentynineteen' ); ?></small>
								</div>
								<div class="col-6">
									<span class="fengshui-color-swatch" data-color="brown"></span>
									<small class="text-uppercase"><?php _e( 'Nâu', 'twentynineteen' ); ?></small>
								</div>
							</div>
						</div>
						<div class="col-md-3 bi-khac">
							<h5><?php _e( 'Bị khắc', 'twentynineteen' ); ?></h5>
							<div class="row">
								<div class="col-6">
									<span class="fengshui-color-swatch" data-color="white"></span>
									<small class="text-uppercase"><?php _e( 'Trắng', 'twentynineteen' ); ?></small>
								</div>
								<div class="col-6">
									<span class="fengshui-color-swatch" data-color="gray"></span>
									<small class="text-uppercase"><?php _e( 'Xám – Ghi xám', 'twentynineteen' ); ?></small>
								</div>
							</div>
						</div>
					</div>
					<h4 class="mt-lg-6 mb-lg-4 my-md-3"><?php _e( 'Đá dành cho cung mệnh', 'twentynineteen' ); ?> <span class="cung-menh"><?php _e( 'unknown', 'twentynineteen' ); ?></span></h4>
				</div>
				<a class="btn-section-close" href="#"><?php _e( 'Close', 'twentynineteen' ); ?></a>
			</div>
			<div class="popular-products py-md-8">
				<div class="container-fluid">
					<h2 class="mb-4 text-center"><?php _e( 'Sản phẩm nổi bật', 'twentynineteen' ); ?></h2>
					<?php echo do_shortcode( '[products limit="4" columns="4" orderby="popularity"]' ); ?>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
