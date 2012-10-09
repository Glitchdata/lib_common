<?php
/**
 * COMMON PDO Db
 * - extends the Zend Db with a few additional functions
 * 
 * @author Terence
 * @copyright Open
 */
class COMMON_DB_PDO extends Zend_Db {

	
	
	
	// We extend the Zend DB with some functions to expose PDO drivers etc...

    public function getPdoType()
    {
        return $this->_pdoType;
    }
	


}


?>
