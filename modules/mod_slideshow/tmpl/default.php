<div id="slideshow-<?= $moduleID ?>" class="mod_slideshow loading <?= $style ?> transition<?= ucfirst($options->transition) ?>"><div>
	<div class="slides"><div>
		<? foreach($slides as $index => $slide): ?>
		<div class="slide"><div>
			<? if ($slide->description1) { echo "<div class=\"description\">{$slide->description1}</div>"; } ?>
			<? if ($slide->image1) { echo "<div class=\"image\"><img src=\"{$imagePath}{$slide->image1}\" alt=\"\" /></div>"; } ?>
		</div></div>
		<? endforeach; ?>
	</div></div>

	<? if ($indicatorStyle): ?>
	<div class="thumbs <?= $indicatorStyle ?>"><div>
		<? foreach($slides as $index => $slide): ?>
		<div class="thumb"><div>
			<? if ($indicatorStyle): ?>
				<? if ($slide->description2) { echo "<div class=\"description\">{$slide->description2}</div>"; } ?>
				<? if ($slide->image2) { echo "<div class=\"image\">{$slide->image2}</div>"; } ?>
			<? elseif($indicatorStyle === 'dots'): ?>
				<div class="dot"></div>
			<? endif; ?>
		</div></div>
		<? endforeach; ?>
	</div></div>
	<? endif; ?>

	<? if ($showControls): ?>
	<div class="controls"><div>
		<div class="playToggle"></div>
		<!--
			<div class="play"></div>
			<div class="pause"></div>
			<div class="next"></div>
			<div class="prev"></div>
		-->
	</div></div>
	<? endif; ?>
</div></div>

<script>
window.addEvent('domready', function() {
	var slideshow = new Slideshow($('slideshow-<?= $moduleID ?>'), <?= json_encode($options) ?>);
	<? if ($autoplay) { echo "slideshow.start();\n"; } ?>
});
</script>
