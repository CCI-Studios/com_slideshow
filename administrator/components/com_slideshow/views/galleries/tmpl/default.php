<? defined('KOOWA') or die('Nooku not installed'); ?>
<? @helper('behavior.mootools') ?>
<style src="media://lib_koowa/css/koowa.css" />
<script src="media://lib_koowa/js/koowa.js" />

<form action="<?= @route('view=galleries') ?>" method="get" class="-koowa-grid">
	<table class="adminlist">
		<thead>
			<tr>
				<th width="10">&nbsp;</th>
				<th width="25"><?= @helper('grid.checkall') ?></th>
				<th><?= @helper('grid.sort', array('column'=>'title')) ?></th>
				<th width="50"><?= @helper('grid.sort', array('column'=>'ordering')) ?></th>
				<th width="50"><?= @text('Slides') ?></th>
				<th width="50"><?= @helper('grid.sort', array('column'=>'id', 'title'=>'ID')) ?></th>
			</tr>
		</thead>
		
		<tfoot>
			<tr>
				<td colspan="6">
					<?= @helper('paginator.pagination', array('total' => $total)) ?>
				</td>
			</tr>
		</tfoot>
		
		<tbody>
			<? foreach($galleries as $gallery): ?>
				<tr>
					<td>&nbsp;</td>
					<td align="center"><?= @helper('grid.checkbox', array('row' => $gallery)) ?></td>
					<td><a href="<?= @route("view=gallery&id={$gallery->id}"); ?>">
						<?= $gallery->title ?>
					</a></td>
					<td align="center"><?= @helper('grid.order', array('row'=>$gallery)) ?></td>
					<td align="center"><a href="<?= @route("view=slides&slideshow_gallery_id={$gallery->id}") ?>">
						<?= @text('Slides'); ?>
					</a></td>
					<td align="center"><?= $gallery->id ?></td>
				</tr>
			<? endforeach; ?>
		</tbody>
	</table>
</form> 