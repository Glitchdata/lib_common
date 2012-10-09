<?php

class COMMON_Utility_CamelCase {


	public function __contruct(){

	}

	static function Cc2Dash($string){
		return preg_replace('/(?<=[a-z])(?=[A-Z])/', '-', $string);
	}

	static function Cc2Underscore($string){
		return preg_replace('/(?<=[a-z])(?=[A-Z])/', '_', $string);
	}

	static function Cc2Text($string){
		return preg_replace('/(?<=[a-z])(?=[A-Z])/', ' ', $string);
	}

}

?>