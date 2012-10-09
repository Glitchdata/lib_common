<?php
/**
 * Base Database Class
 * - contains generic DB functions
 * @author Terence
 * @copyright Open
 */
class COMMON_DB_Base {

	public $adapter;
	public $host;
	public $username;
	public $password;
	public $dbname;
	public $port;

	public function __construct(){
		
	}
	
	
	
	public function setAdapter($adapter){
		$this->adapter = $adapter;
	}
	

}


?>
