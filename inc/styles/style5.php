<?php
$columns = ($columns != '') ? $columns : '3';
$fields_to_show = ($fields_to_show != '') ? $fields_to_show : 'property_type,property_status,property_bedrooms,property_purpose';
?>
<div class="ich-settings-main-wrap" id="filter-map-style-4">
	<div class="row">
		<div class="col-sm-12 rem=map-search-form-wrapper">
			<?php echo do_shortcode( '[rem_map_search_form
			fields_to_show="'.$fields_to_show.'"
			search_btn_text="'.$search_btn_text.'"
			reset_btn_text="'.$reset_btn_text.'"
			filters_btn_text="'.$filters_btn_text.'"
			fixed_fields="'.$fixed_fields.'"
			disable_eq_height="'.$disable_eq_height.'"
			agent_id="'.$agent_id.'"
			fields_margin="'.$fields_margin.'"
			icons_by_meta="'.$icons_by_meta.'"
			slider_bg_color="'.$slider_bg_color.'"
			slider_handle_color="'.$slider_handle_color.'"
			slider_badge_bg_color="'.$slider_badge_bg_color.'"
			slider_badge_text_color="'.$slider_badge_text_color.'"			
			icons_data="'.$icons_data.'"
			columns="'.$columns.'"]' ); ?>
		</div>
		<div class="col-sm-6 rem-listings-wrapper" style="height: <?php echo esc_attr( $map_height ); ?>">
			<?php echo do_shortcode( "[rem_map_search_results]" ); ?>
		</div>
		<div class="col-sm-6 rem-map-area-wrapper">
			<?php echo do_shortcode( "[rem_map_area
			lat='".$lat."'
			long='".$long."'
			zoom='".$zoom."'
			map_height='".$map_height."'
			address='".$address."']" ); ?>
		</div>
	</div>
</div>
<?php
	if ($loader_url != '') { ?>
		<style>
			.fmp_imageover {
				background-image: url(<?php echo $loader_url; ?>) !important;
			}
		</style>
	<?php }
?>