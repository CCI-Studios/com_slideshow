<? defined('KOOWA') or die('Nooku not installed'); ?>
<? @helper('behavior.mootools') ?>
<style src="media://lib_koowa/css/koowa.css" />
<script src="media://lib_koowa/js/koowa.js" />

<form action="<?= @route('view=slides') ?>" method="get" class="-koowa-grid">
	<table class="adminlist">
		<thead>
			<tr>
				<th width="10">&nbsp;</th>
				<th width="25"><?= @helper('grid.checkall') ?></th>
				<th><?= @helper('grid.sort', array('column' => 'title')) ?></th>
				<th width="150"><?= @text('Slide') ?></th>
				<th width="75"><?= @helper('grid.sort', array('column'=>'slideshow_gallery_id', 'title'=>'Gallery ID')) ?></th>
				<th width="25"><?= @helper('grid.sort', array('column'=>'ordering')) ?></th>
				<th width="50"><?= @helper('grid.sort', array('column'=>'id', 'title'=>'ID')) ?></th>
			</tr>
		</thead>
		
		<tfoot>
			<tr>
				<td colspan="7">
					<?= @helper('paginator.pagination', array('total' => $total)) ?>
				</td>
			</tr>
		</tfoot>
		
		<tbody>
			<? foreach($slides as $slide): ?>
				<tr>
					<td>&nbsp;</td>
					<td align="center"><?= @helper('grid.checkbox', array('row' => $slide)) ?></td>
					<td><a href="<?= @route("view=slide&id={$slide->id}"); ?>">
						<?= $slide->title ?>
					</a></td>
					<td align="center">
						<? if ($slide->image1): ?>
							<img src="/media/com_slideshow/uploads/<?= $slide->image1 ?>" width="150" />
						<? endif; ?>
					</td>
					<td align="center"><a href="<?= @route("view=gallery&id={$slide->slideshow_gallery_id}") ?>">
						<?= $slide->slideshow_gallery_id ?>
					</a></td>
					<td align="center">
						<?= @helper('grid.order', array('row'=>$slide)) ?>
					</td>
					<td align="center"><?= $slide->id ?></td>
				</tr>
			<? endforeach; ?>
		</tbody>
	</table>
</form> 