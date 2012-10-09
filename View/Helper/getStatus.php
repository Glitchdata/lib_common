<?php

/**
 * getStatus - translates status to Status for display purposes. 
 * - used in ....
 * 
 * @author Terence
 * @version 3.0
 *
 */
class COMMON_View_Helper_getStatus extends COMMON_View_Helper_Base
{
    public function getStatus($id)
    { 
    	switch($id){
    		case 0:
    			$value = 'InActive';
    			break;
    		case 1:
    			$value = 'Active';
    			break;
    		default:
    			$value = 'Unknown';
    			break;	
    	}
    	
    	return $value;
    }
	

}

