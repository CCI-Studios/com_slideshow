<?php
defined('KOOWA') or die;

echo KService::get('mod://site/slideshow.html')
	->module($module)
	->display();