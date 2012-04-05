<?php

class ComSlideshowTemplateHelperListbox extends ComDefaultTemplateHelperListbox
{

	public function galleries( $config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'model'		=> 'galleries',
			'name' 		=> 'slideshow_gallery_id',
			'value'		=> 'id',
			'text'		=> 'title',
			'prompt'	=> '- Select Gallery -',
			'attribs'    => array('id' => $config->name)
		));

		return parent::_listbox($config);
	}
}