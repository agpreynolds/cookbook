<?php

class fileUpload {
	private $config;
	private $validators;
	private $uploadPath;
	/*
		* Construct for file upload class
		* Expected args :
			- Required : filehandle
			- Optional : filename
			- Optional : array - validators
				- Filetypes
				- Filesize
			- Optional : string - uploadPath
		* validators set by default in fileUpload config
		* uploadPath set by default in fileUpload config
	*/
	public function __construct($args) {
		if ( !isset($args['filehandle']) ) {
			return null;
		}

		$this->file = $args['filehandle'];
		
		$this->config = getConfig('fileUpload');

		$this->validators = $this->config['validators'];

		if ( isset($args['uploadPath']) ) {
			$this->uploadPath = $args['uploadPath'];
		}
		else {
			$this->uploadPath = $this->config['uploadPath'];
		}

		if ( isset($args['filename']) ) {
			$this->uploadPath .= $args['filename'] . '.' . pathinfo($this->file['name'],PATHINFO_EXTENSION);
		}
		else {
			$this->uploadPath .= $this->file['name'];			
		}

		if ($this->isValid()) {
			return $this->upload();
		}
		return null;
	}
	
	private function isValid() {
		return 1;
	}

	private function fileSize() {
		return ( $this->file['size'] < $this->validators['fileSize'] ) ? 1 : 0;
	}
	
	private function upload() {
		move_uploaded_file($this->file['tmp_name'], $this->uploadPath);
	}
}

?>