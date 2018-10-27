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
			<div class="fengshui-dicover text-center py-md-6">
				<h2 class="mb-1"><?php _e( 'Phong thủy', 'twentynineteen' ); ?></h2>
				<h5><?php _e( 'Bắt đầu hành trình khám phá bản thân', 'twentynineteen' ); ?></h5>
				<div class="form-fengshui-discover row">
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
				<div class="text-left">
				<?php
					$solar              = new Solar();
					$solar->solar_year  = 1989;
					$solar->solar_month = 1;
					$solar->solar_day   = 31;
					$lunar              = LunarSolarConverter::solar_to_lunar( $solar );
					echo '<pre>', var_dump( $solar ), '</pre>';
					echo '<pre>', var_dump( $lunar ), '</pre>';
					$solar = LunarSolarConverter::lunar_to_solar( $lunar );
					echo '<pre>', var_dump( $solar ), '</pre>';
					echo '<pre>', var_dump( $lunar ), '</pre>';
				?>
				</div>
			</div>
			<div id="fengshui-display" class="fengshui-display text-center">
				<h3 class="mb-2"><?php _e( 'Phong thủy của bạn', 'twentynineteen' ); ?></h3>
				<p class="mb-0"><?php _e( 'Dương lịch', 'twentynineteen' ); ?>: <span><?php _e( '31/01/1989', 'twentynineteen' ); ?></span> – <?php _e( 'Âm lịch', 'twentynineteen' ); ?>: <span><?php _e( '24/12/1988', 'twentynineteen' ); ?></span></p>
				<p><?php _e( 'Sinh mệnh', 'twentynineteen' ); ?>: <span><?php _e( 'đại lâm mộc', 'twentynineteen' ); ?></span> – <?php _e( 'Cung mệnh', 'twentynineteen' ); ?>: <span><?php _e( 'mộc', 'twentynineteen' ); ?></span></p>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
