<?php
global $rem_ob;

$default_fields = $rem_ob->single_property_fields();
if (is_array($fields_to_show)) {
	$fields_arr =  $fields_to_show;
} else {
	$fields_arr =  explode(',', $fields_to_show );
}

$property_individual_cbs = $rem_ob->get_all_property_features();
?>

<div class="ich-settings-main-wrap" id="rem-filter-map-google">
	<form class="map-filter-form" action="<?php echo admin_url( 'admin-ajax.php' ); ?>">
		<?php
			if ($fixed_fields != '') {
				$fixed_va_arr = explode(",", $fixed_fields);
				foreach ($fixed_va_arr as $fixed_va) {
					$fixed_data = explode("|", $fixed_va);
					echo '<input type="hidden" name="'.$fixed_data[0].'" value="'.$fixed_data[1].'">';
				}
			}
			if ($agent_id != '') {
					echo '<input type="hidden" name="agent_id" value="'.$agent_id.'">';
			}
		?>
		<input type="hidden" name="action" value="rem_map_filters">
		<input type="hidden" name="icons_by_meta" value="<?php echo $icons_by_meta; ?>">
		<input type="hidden" name="icons_data" value='<?php echo stripcslashes(json_encode($map_icons)); ?>'>
		<div class="row <?php echo ($disable_eq_height != 'yes') ? 'wcp-eq-height' : '' ; ?>">
			
			<?php if ($radius_search == 'enable') { ?>
				<div class="col-sm-6 col-md-<?php echo $columns; ?> field-margin">
					<input class="form-control pac-target-input" autocomplete="off" type="text" id="rem_search_addresses" placeholder="<?php _e( 'Location', 'rem-map-filters' ); ?>" />
				</div>
				<div class="col-sm-6 col-md-<?php echo $columns; ?> field-margin">
					<input class="form-control" name="radius" type="number" min="0" id="rem_radius_value" placeholder="<?php _e( 'Radius', 'rem-map-filters' ); ?>" />
				</div>
				<div class="col-sm-6 col-md-<?php echo $columns; ?> field-margin">
					<select id="rem_radius_unit" name="radius_unit" class="form-control">
						<option value="mi"><?php _e( 'Miles', 'rem-map-filters' ); ?></option>
						<option value="km"><?php _e( 'kilometers', 'rem-map-filters' ); ?></option>
					</select>
				</div>
				<div class="rem_current_position">
					<input type="hidden" class="rem_search_latitude" name="latitude" value="">
					<input type="hidden" class="rem_search_longitude" name="longitude" value="">
				</div>
			<?php } ?>

			<?php if (in_array('search', $fields_arr)) { ?>
				<div class="col-sm-6 col-md-<?php echo $columns; ?> field-margin">
					<input class="form-control" type="text" name="search_property" id="keywords" placeholder="<?php _e( 'Keywords', 'rem-map-filters' ); ?>" />
				</div>
			<?php } else {
				echo '<input value="" type="hidden" name="search_property" />';
			} ?>

			<?php foreach ($default_fields as $field) {

				$show_condition = isset($field['show_condition']) ? $field['show_condition'] : 'true' ; 
				$conditions = isset($field['condition']) ? $field['condition'] : array() ;
				if (in_array($field['key'], $fields_arr) && 'property_price' != $field['key']){ ?>
					<div class="col-sm-6 col-md-<?php echo $columns; ?> field-margin search-field" data-condition_status="<?php echo $show_condition; ?>" data-condition_bound="<?php echo isset($field['condition_bound']) ? $field['condition_bound'] : 'all' ?>" data-condition='<?php echo json_encode($conditions); ?>'>
						<span id="span-<?php echo $field['key']; ?>" data-text="<?php echo $field['title']; ?>"></span>
						<?php $this->render_property_search_fields($field, 'top'); ?>
					</div>
				<?php }
			} ?>

			<?php foreach ($fields_arr as $key) { if( $key == 'order' || $key == 'tags' || $key == 'orderby' || $key == 'agent'|| $key == 'property_id'){ ?>
					<div class="col-sm-6 col-md-<?php echo $columns; ?> field-margin search-field">
						<?php rem_render_special_search_fields($key); ?>
					</div>
			<?php }} ?>			

			
			<?php if (in_array('property_price', $fields_arr)) { ?>
				<div class="p-slide-wrap col-sm-6 col-md-<?php echo $columns ?> field-margin">
					<?php rem_render_price_range_field('shortcode'); ?>
				</div>
			<?php } ?>
			<div class="filter hide-filter field-margin col-sm-12">
				<?php foreach ($property_individual_cbs as $cb) { ?>
						<div class="<?php echo $more_filters_column_class; ?>">
							<?php
								$cb = stripcslashes($cb);
								$translated_text = (function_exists('pll__')) ? pll__($cb) : __( $cb, 'rem-map-filters' );
							?>
							<input class="labelauty" type="checkbox" name="detail_cbs[<?php echo $cb; ?>]" data-labelauty="<?php echo $translated_text; ?>">
						</div>
				<?php } ?>
			</div>
			<?php if ($filters_btn_text != '') { ?>
				<div class="p-slide-wrap col-sm-6 col-md-<?php echo $columns ?> field-margin">
					<button type="button" class="btn btn-default more-button">
						<?php echo $filters_btn_text; ?>
					</button>
				</div>
			<?php } ?>
			<div class="p-slide-wrap col-sm-6 col-md-<?php echo $columns ?> field-margin">
				<input type="submit" value="<?php echo $search_btn_text; ?>" class="btn btn-block btn-default">
			</div>
		</div>
	</form>
</div>

<style>
	#rem-filter-map-google .map-filter-form .field-margin {
		margin: <?php echo $fields_margin; ?>;
	}
	#rem-filter-map-google .map-filter-form .noUi-origin.noUi-connect {
		background-color: <?php echo $slider_bg_color; ?> !important;
	}
	#rem-filter-map-google .map-filter-form .noUi-horizontal .noUi-handle {
		background-color: <?php echo $slider_handle_color; ?> !important;
	}
	#rem-filter-map-google .map-filter-form .noUi-horizontal .noUi-handle {
		background-color: <?php echo $slider_handle_color; ?> !important;
	}
	#rem-filter-map-google .map-filter-form #price-value-min,
	#rem-filter-map-google .map-filter-form #price-value-max {
		background-color: <?php echo $slider_badge_bg_color; ?> !important;
		color: <?php echo $slider_badge_text_color; ?> !important;
	}
	#rem-filter-map-google .map-filter-form #price-value-max:after {
		border-right-color: <?php echo $slider_badge_bg_color; ?> !important;
	}
	#rem-filter-map-google .map-filter-form #price-value-min:after {
		border-left-color: <?php echo $slider_badge_bg_color; ?> !important;
	}	
</style>