<?php

class COMMON_Utility_InputFilter {

	private $myFilter;

	public function __contruct(){

	}

	static function sanitize($value){
		$this->myFilter = new Zend_Filter();
		$this->myFilter->addFilter(new Zend_Filter_StripTags());
		$this->myFilter->addFilter(new Zend_Filter_StringTrim());
		
		return $this->myFilter->filter($value);
	
	}

}

?>