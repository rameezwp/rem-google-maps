<div class="ich-settings-main-wrap">
	<div id="map-canvas" style="height:<?php echo $map_height; ?>;"></div>
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