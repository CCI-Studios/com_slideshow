<?php

class ComSlideshowDatabaseBehaviorUploadable extends KDatabaseBehaviorAbstract
{

	protected $_columns;
	protected $_upload_key;
	protected $_delete_key;
	protected $_location;

	public function __construct(KConfig $config)
	{
		parent::__construct($config);

		$this->_columns = $config->columns;
		$this->_upload_key = $config->upload_key;
		$this->_delete_key = $config->delete_key;
		$this->_location = $config->location;
	}

	protected function _initialize(KConfig $config)
	{
		$config->append(array(
			'columns'		=> array(),
			'upload_key'	=> '_upload',
			'delete_key'	=> '_delete',
			'location'		=> '',
		));

		parent::_initialize($config);
	}

	protected function _beforeTableDelete(KCommandContext $context)
	{
		$this->_deleteFiles();
	}

	protected function _afterTableInsert(KCommandContext $context)
	{
		$post = $context->data;
		$this->_uploadFiles($post);
		$this->save();
	}

	protected function _afterTableUpdate(KCommandContext $context)
	{
		$post = $context->data;
		$this->_uploadFiles($post);
		$this->save();
	}


	protected function _uploadFiles($post)
	{
		foreach($this->_columns as $column)
			$this->_uploadFile($column, $post);
	}

	protected function _uploadFile($column, $post)
	{
		$file = KRequest::get('FILES.'.$column.$this->_upload_key, 'raw');
 		$location = $this->_fullpath();


 		if (isset($post->{$column.$this->_delete_key})) {
 			$this->_deleteFile($column);
 		}

 		if ($file == null || $file['error'] === 4) { // no file
 			return;
 		}

 		if ($file['error'] !== 0 && $file['error'] !== 4) {
 			JError::raiseWarning('300', 'Error uploading file.');
 			return;
 		}

 		do {
 			$filename = date('Y-m-d-h-m-s') .'-'. rand() .'.'. JFile::getExt($file['name']);
 		} while(JFile::exists($location.$filename));

		if (JFile::upload($file['tmp_name'], $location.$filename)) {
			$this->{$column} = $filename;
		} else {
			JError::raiseWarning('300', 'Error saving file.');
		}
	}

	protected function _deleteFiles()
	{
		foreach($this->_columns as $column)
			$this->_deleteFile($column);
	}
	protected function _deleteFile($column)
	{
		JFile::delete($this->_fullpath() . $this->{$column});
		$this->{$column} = '';
	}

	protected function _fullpath()
	{
		return JPATH_SITE .'/'. $this->_location;
	}

}