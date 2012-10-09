<?php

/**
 * COMMON_Security provides basic session security functionality.
 * - exits user to login/timeout if Login details do not exist.
 * - should be integrated with User Logs / Zend Log for regular logging.
 * - COMMON_Security should be initiated in Base Controller vs. Bootstrap as it depends on frontController methods.
 * - extensions to this class would probably implement application specfic security.
 * 
 * @author Terence Chia
 * @package COMMON
 *
 */
class COMMON_Security {
	public function __construct(){
		$this->init();	
		
	}
	
	public function init(){
	}
	
	
	
	
	
	
}

