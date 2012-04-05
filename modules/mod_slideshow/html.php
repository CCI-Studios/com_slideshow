<?php

class ModSlideshowHtml extends ModDefaultHtml
{
	
	public function display()
	{
		$doc = JFactory::getDocument();
		$params = $this->module->params;
		// FIXME: load slideshow 4relz
		$model = $this->getService('com://admin/slideshow.model.slides');
		$slides = $model->set('slideshow_gallery_id', $params->get('slideshow_gallery_id'))->getList();

		$this->assign('slides', $slides);
		$this->assign('imagePath', 'media/com_slideshow/uploads/');
		
		$this->assign('style', $params->get('style'));
		$this->assign('indicatorStyle', $params->get('indicator'));
		$this->assign('moduleID', $this->module->id);

		$this->assign('options', (object)array(
			'transition'	=> $params->get('transition'),
			'duration'		=> $params->get('duration'),
			'delay'			=> $params->get('delay')
		));

		$this->assign('showControls', $params->get('showControls'));
		$this->assign('autoplay', $params->get('autoplay'));

		if ($params->get('css')) {
			$doc->addStylesheet('media/com_slideshow/com_slideshow.css');
			$doc->addStylesheet('media/com_slideshow/template.css');
		}

		if ($params->get('js')) {
			$doc->addScript('media/com_slideshow/com_slideshow.js');
		}

	 	return parent::display();	
	}
	
}