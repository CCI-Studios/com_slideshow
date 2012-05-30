<? defined("KOOWA") or die('Nooku is not installed or enabled'); ?>
<? @helper('behavior.mootools') ?>
<style src="media://lib_koowa/css/koowa.css" />
<script src="media://lib_koowa/js/koowa.js" />
<style src="media://com_bars/css/com_bars.css" />

<form action="<?= @route("view=slide&id={$slide->id}") ?>" method="post" class="-koowa-form" enctype="multipart/form-data">
	<input type="hidden" name="MAX_FILE_SIZE" value="500000" />
	
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?= @text('Slide Details') ?></legend>
			
			<ul class="adminformlist">
				<li>
					<label for="field_gallery"><?= @text('Gallery') ?></label>
					<?= @helper('listbox.galleries', array()) ?>
				</li>
				<li>
					<label for="field_title"><?= @text('Title') ?></label>
					<input type="text" id="field_title" name="title" value="<?= $slide->title ?>" />
				</li>
				<li>
					<label for="field_link"><?= @text('Link') ?></label>
					<input type="text" id="field_link" name="link" value="<?= $slide->link ?>" />
				</li>
			</ul>
		</fieldset>
		
		<fieldset class="adminform">
			<legend><?= @text('Details') ?></legend>
			<?= @editor(array('height' => 100, 'name' => 'description1')); ?>
		</fieldset>

		<fieldset class="adminform">
			<legend><?= @text('Thumbnail') ?></legend>
			<?= @editor(array('height' => 100, 'name' => 'description2')); ?>
		</fieldset>
	</div>

	<div class="width-40 fltrt">
		<fieldset class="adminform">
			<legend><?= @text('Slide Details') ?></legend>

			<ul class="adminformlist">
				<? if (!$slide->image1): ?>
					<li>
						<label for="field_image1"><?= @text('Main Image') ?></label>
						<input type="file" name="image1_upload" />
					</li>
				<? else: ?>
					<li>	
						<img src="<?= "/media/com_slideshow/uploads/{$slide->image1}" ?>" style="max-width: 100%" />
					</li>
					<li>
						<label for="field_image1_delete"><?= @text('Delete Image 1')?></label>
						<input type="checkbox" name="image1_delete" />
					</li>
				<? endif; ?>
				<? if (!$slide->image2): ?>
					<li>
						<label for="field_image2"><?= @text('Thumbnail Image') ?></label>
						<input type="file" name="image2_upload" />
					</li>
				<? else: ?>
					<li>	
						<img src="<?= "/media/com_slideshow/uploads/{$slide->image2}" ?>" style="max-width: 100%" />
					</li>
					<li>
						<label for="field_image2_delete"><?= @text('Delete Image 2')?></label>
						<input type="checkbox" name="image2_delete" />
					</li>
				<? endif; ?>
		</fieldset>
	</div>
</form>