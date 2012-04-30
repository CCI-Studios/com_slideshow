<div id="slideshow-<?= $moduleID ?>" class="mod_slideshow loading <?= $style ?>"><div><div>
	<div class="overlay1"><div></div></div>
	<div class="overlay2"><div></div></div>
	<div class="overlay3"><div></div></div>
	<div class="overlay4"><div></div></div>
	
	<div class="slides"><div>
		<? $first = true;
		foreach($slides as $index => $slide): ?>
		<div class="slide <?php if ($first) { echo 'active'; $first = false; } ?>"><div>
			<? if ($slide->description1) { echo "<div class=\"description\"><div>{$slide->description1}</div></div>"; } ?>
			<? if ($slide->image1) { echo "<div class=\"image\"><img src=\"{$imagePath}{$slide->image1}\" alt=\"\" /></div>"; } ?>
		</div></div>
		<? endforeach; ?>
	</div></div>

	<? if ($indicatorStyle): ?>
	<div class="thumbs <?= $indicatorStyle ?>"><div>
		<? $first = true;
		foreach($slides as $index => $slide): ?>
		<div class="thumb <?php if ($first) { echo 'active'; $first = false; } ?>"><div><div>
			<? if ($indicatorStyle): ?>
				<? if ($slide->description2) { echo "<div class=\"description\">{$slide->description2}</div>"; } ?>
				<? if ($slide->image2) { echo "<div class=\"image\">{$slide->image2}</div>"; } ?>
			<? elseif($indicatorStyle === 'dots'): ?>
				<div class="dot"></div>
			<? endif; ?>
		</div></div></div>
		<? endforeach; ?>
	</div></div>
	<? endif; ?>

	<? if ($showControls) {
		echo @template('controls');
	} ?>
</div></div></div>

<script>
window.addEvent('domready', function() {
	var slideshow = new Slideshow.<?= ucfirst($style) ?>('slideshow-<?= $moduleID ?>', <?= json_encode($options) ?>);
	<? if ($autoplay): ?>
	slideshow.addEvent('ready', function () {
		slideshow.start();
	});
	<? endif; ?>
});
</script>
