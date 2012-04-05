<? defined("KOOWA") or die('Nooku is not installed or enabled'); ?>
<? @helper('behavior.mootools') ?>
<style src="media://lib_koowa/css/koowa.css" />
<script src="media://lib_koowa/js/koowa.js" />

<form action="<?= @route('view=gallery&id='. $gallery->id) ?>" method="post" class="-koowa-form">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?= @text('Gallery Details') ?></legend>
			
			<ul class="adminformlist">
				<li>
					<label for="field_title"><?= @text('Title') ?></label>
					<input type="text" id="field_title" name="title" value="<?= $gallery->title ?>" />
				</li>
			</ul>
		</fieldset>
	</div>
</form>