<?php

class ComSlideshowModelSlides extends ComDefaultModelDefault
{

	public function __construct(KConfig $config)
	{
		parent::__construct($config);

		$this->_state
			->insert('slideshow_gallery_id', 'int');
	}

	protected function _buildQueryWhere(KDatabaseQuery $query)
	{
		$state = $this->_state;

		if (is_numeric($state->slideshow_gallery_id)) {
			$query->where('slideshow_gallery_id', '=', $state->slideshow_gallery_id);
		}

		parent::_buildQueryWhere($query);
	}

}