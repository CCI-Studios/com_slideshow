<?php
defined('KOOWA') or die;

echo KService::get('com://admin/slideshow.dispatcher')->dispatch();