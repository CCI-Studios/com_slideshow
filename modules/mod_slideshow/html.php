<?php

class ModSlideshowHtml extends ModDefaultHtml
{
	
	public function display()
	{
		$doc = JFactory::getDocument();
		$params = $this->module->params;
		
		$model = $this->getService('com://admin/slideshow.model.slides');
		$slides = $model->set('slideshow_gallery_id', $params->get('slideshow_gallery_id'))->getList();

		$this->assign('slides', $slides);
		$this->assign('imagePath', 'media/com_slideshow/uploads/');
		
		$this->assign('style', $params->get('style', 'horizontal'));
		$this->assign('indicatorStyle', $params->get('indicator', 'dots'));
		$this->assign('moduleID', $this->module->id);

		$this->assign('options', (object)array(
			'duration'		=> $params->get('duration', 500),
			'delay'			=> $params->get('delay', 5000),
		));

		$this->assign('showControls', $params->get('showControls', 0));
		$this->assign('autoplay', $params->get('autoplay', 1));

		$style = $params->get('style', 'horizontal');
		if ($params->get('css', 1)) {
			$doc->addStylesheet("media/com_slideshow/css/com_slideshow-$style.css");
		}

		if ($params->get('js', 1)) {
			$doc->addScript("media/com_slideshow/js/com_slideshow.js");
			$doc->addScript("media/com_slideshow/js/com_slideshow-$style.js");
		}

		$this->assign('params', $params);

	 	return parent::display();	
	}
	
}