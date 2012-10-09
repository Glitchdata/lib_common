<?php
/**
 * MSSQL Native Database Connection Manager
 * - this is all crap code.
 * - we probably won't need to use this.
 * @author adopted from old daos
 * @copyright Open
 *
 */
class COMMON_MSSQL_DB extends COMMON_DB_Base {

	public $dba;
	private static $_instance = null;



	private function __construct ($host, $dbname, $username, $password) {
		$this->host = $host;
		$this->dbname = $dbname;
		$this->username = $username;
		$this->password = $password;

		$this->connect();
		// Register?
		// $this->setDB($this->dbname, $this->dba);
		
	}

	public function connect(){
		// TODO public function connect($database_config){
		// TODO We should pass a $database_config array to connect in future.
		$this->dba = mssql_connect($this->host, $this->username, $this->password);
		mssql_select_db($this->dbname, $this->dba);
		if (!$this->dba){
			throw new Exception('Cannot connect to the database');
		}
		return $this->dba;
	}


	public function setDB($database_name, $database_connection){
		 
	}

	function getDB($database_name){
		if(!empty($database_name)){
			if (Zend_Registry::isRegistered('db_'.$database_name))
				$db = Zend_Registry::get('db_'.$database_name);
			else
				$db = Zend_Registry::get('db_gist');
		}else{
				$db = Zend_Registry::get('db_gist');
		}
		return $db;
	}

	/**
	 * getDBConfig - attempting to mirror PDO equivalents
	 *
	 * @param unknown_type $database_name
	 * @return unknown
	 */
	function getDbConfig($database_name){
		$db 		= Zend_Registry::get('db_'.$database_name);
		
		// TODO Getting config might be challenging

		
//		$db->setFetchMode(Zend_Db::FETCH_ASSOC);
//		$dbConf 		= $db->getConfig();
//		return $dbConf;
	}



	/**
	 * getDBName - attempting to mirror PDO equivalents
	 *
	 * @param unknown_type $database_name
	 * @return unknown
	 */
	function getDbName($database_name){
		$db 		= Zend_Registry::get('db_'.$database_name);
		// TODO Getting config might be challenging
		
//		$db->setFetchMode(Zend_Db::FETCH_ASSOC);
//		$dbConf 		= $db->getConfig();
//		$dbName 		= $dbConf["dbname"];
//		return $dbName;
	}
	
	


	
	
}



?>
