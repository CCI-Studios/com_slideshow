<?php
defined('KOOWA') or die;

class ComSlideshowControllerToolbarMenubar extends ComDefaultControllerToolbarMenubar
{

	public function getCommands()
	{
		$name = $this->getController()->getIdentifier()->name;

		$this->addCommand('Galleries', array(
			'href'		=> JRoute::_('index.php?option=com_slideshow&view=galleries'),
			'active'	=> ($name === 'gallery')
		));

		$this->addCommand('Slides', array(
			'href'		=> JRoute::_('index.php?option=com_slideshow&view=slides'),
			'active'	=> ($name === 'slide')
		));

		return parent::getCommands();
	}

}