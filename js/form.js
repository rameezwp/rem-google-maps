jQuery(document).ready(function($){
	$('#rem-filter-map-google .price-range').each(function(index, element) {
		var formatter = wNumb({
		    decimals: parseInt(rem_map_form_data.decimal_points),
		    mark: rem_map_form_data.decimal_separator,
		    thousand: rem_map_form_data.thousand_separator,
		});

		noUiSlider.create(element, {
			start: [ parseInt(rem_map_form_data.price_min_default), parseInt(rem_map_form_data.price_max_default) ],
			behaviour: 'drag',
			direction: rem_map_form_data.site_direction,
			connect: true,
			step: 1,
			range: {
			    'min': parseInt(rem_map_form_data.price_min),
			    'max': parseInt(rem_map_form_data.price_max)
			},
			format: formatter,
		});

		var wrap = $(this).closest('.p-slide-wrap');
        element.noUiSlider.on("update", function (values, handle) {
            var minValue = wrap.find('#price-value-min');
            var maxValue = wrap.find('#price-value-max');
            var minInput = wrap.find('#min-value');
            var maxInput = wrap.find('#max-value');
            
            if (handle === 0) {  // Handle for the lower slider
                minValue.text(values[0]);
                minInput.val(formatter.from(values[0]));
            } else {  // Handle for the upper slider
                maxValue.text(values[1]);
                maxInput.val(formatter.from(values[1]));
            }
        });
	});


	if (jQuery('.labelauty-unchecked-image').length == 0) {
		jQuery(".labelauty").labelauty();
	}
	var $filter = jQuery('.filter', '#rem-filter-map-google');
	jQuery(".more-button", '#rem-filter-map-google').on('click', function(){
		$filter.toggleClass('hide-filter');
		return false;
	});

});