<?php

class ModSlideshowHtml extends ModDefaultHtml
{
	
	public function display()
	{
		$doc = JFactory::getDocument();
		$params = $this->module->params;
		// FIXME: load slideshow 4relz
		$slides = array(
			(object)array('description1'=>'<h3>Welcome to Field Farms Marketing Ltd.</h3><p class="link"><a href="/about-us">About Us</a></p>', 'image1'=>'slide1.jpeg', 'description2'=>'adfs', 'image2'=>'asdf;lk'),
			(object)array('description1'=>'<h3>Welcome to Field Farms Marketing Ltd.</h3><p class="link"><a href="/about-us">About Us</a></p>', 'image1'=>'slide2.jpeg', 'description2'=>'adfs', 'image2'=>'asdf;lk'),
			(object)array('description1'=>'<h3>Welcome to Field Farms Marketing Ltd.</h3><p class="link"><a href="/about-us">About Us</a></p>', 'image1'=>'slide3.jpeg', 'description2'=>'adfs', 'image2'=>'asdf;lk'),
		);
		$this->assign('slides', $slides);
		$this->assign('imagePath', 'media/com_slideshow/uploads/gallery1/');
		
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