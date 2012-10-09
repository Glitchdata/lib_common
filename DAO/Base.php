<?php
/**
 * Common Data Access Object base
 *
 * @author Terence
 * @version 0.1
 *
 */

class COMMON_DAO_Base {

	const FILTER_NONE = 0;
	const ORDER_NONE = 0;
	
	const DBTYPE_SQLSERVER = 1;
	const DBTYPE_MYSQL = 2;
	const DBTYPE_POSTGRES = 3;
	const DBTYPE_ORACLE = 4;
	const DBTYPE_DB2 = 5;
		
	public $db = array();
	public $dbs = array();		// initialising an_array of data adapters
	protected $_db_type				= COMMON_DAO_Base::DBTYPE_SQLSERVER;
	protected $_schema_name			= "dbo";
	protected $_table_name			= "a_default_table";
	public $_db_adapter			= "a_default_db_adapter";
	
	protected $_table_metadata;
	protected $_table_column_names;


	public function __construct() {
	}


	public function setDB($database_name, $database_adapter, $database_config){
//		var_dump ($database_config); exit;		
		$dba = Zend_Db::factory($database_config);
		Zend_Registry::set("db_{$database_name}", $dba);
	}


	/**
	 * Get DB Connector from Registry
	 *
	 * @param unknown_type $database_name
	 * @return unknown
	 */
	function getDB($database_name){
		if(!empty($database_name)){
			if (Zend_Registry::isRegistered('db_' . $database_name))
			$dba = Zend_Registry::get('db_' . $database_name);
			else
			$dba = Zend_Registry::get('db_admin');
		}
		return $dba;
	}


	/**
	 * getDBName
	 *
	 * @param unknown_type $database_name
	 * @return unknown
	 */
	function getDbConfig($database_name){
		$dba	= Zend_Registry::get('db_' . $database_name);
		$dba->setFetchMode(Zend_Db::FETCH_ASSOC);
		$dbaConf	= $dba->getConfig();
//		var_dump ($dbaConf); exit;
		return $dbaConf;
	}


	/**
	 * getDBName
	 *
	 * @param unknown_type $database_name
	 * @return unknown
	 */
	function getDbName($database_name){
		$dba 		= Zend_Registry::get('db_' . $database_name);
		$dba->setFetchMode(Zend_Db::FETCH_ASSOC);
		$dbaConf 		= $dba->getConfig();
		return $dbaConf["dbname"];
	}
	
	
	/**
	 * getDbConnection
	 * @param $database_name
	 * @return unknown_type
	 */
	function getDbConnection($database_name){
		$dba		= Zend_Registry::get('db_' . $database_name);
		$dbConnection 		= $dba->getConnection();
//		var_dump ($dbConnection); exit;
		return $dbConnection;
	}

	
	public function getServerVersion($database_name){
		$dba 		= Zend_Registry::get('db_' . $database_name);
		$dbServerVersion = $dba->getServerVersion();
//		var_dump ($dbServerVersion); exit;
		return $dbServerVersion;
	}

}


