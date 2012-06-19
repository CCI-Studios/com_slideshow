<?php
defined('KOOWA') or die();

class ComSlideshowDatabaseTableSlides extends KDatabaseTableDefault
{

	protected function _initialize(KConfig $config)
	{
		$uploadable = $this->getService('com://admin/slideshow.database.behavior.uploadable', array(
			'columns' 	=> array('image1', 'image2'),
			'location'	=> 'media/com_slideshow/uploads/'
		));

		$config->append(array(
			'behaviors'	=> array($uploadable, 'orderable'),
		));

		parent::_initialize($config);
	}

}