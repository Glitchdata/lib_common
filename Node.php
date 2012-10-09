<?php

/**
 * COMMON_Node keeps track of the last 50 actions of the user in memory
 * - used to determine return paths
 * - used to determine application context
 * - should be integrated with User Logs / Zend Log for regular logging.
 * - COMMON_Node should be initiated in Base Controller vs. Bootstrap as it depends on frontController methods.
 * 
 * @author Terence Chia
 * @package COMMON
 *
 */
class COMMON_Node {
	
	
	public function __construct(){
		$nodeNS = new Zend_Session_Namespace('Node');
		$front = Zend_Controller_Front::getInstance();
		
	}
	
	public function push() {
		$nodeNS = new Zend_Session_Namespace('Node');
		$front = Zend_Controller_Front::getInstance();
				
		// Push Additional value onto Node stack
		if (empty($nodeNS->microhistory)) {
			//	echo "nodeNS is empty"; exit;
			$nodeNS->microhistory[] = array(
									$front->getRequest()->getControllerName(),
									$front->getRequest()->getActionName(),
									$front->getRequest()->getParam('q', ''),
									$front->getRequest()->getParam('p', 1),
									$front->getRequest()->getParam('ps', 10),
									$front->getRequest()->getParam('f', COMMON_DAO_Base::FILTER_NONE),
									$front->getRequest()->getParam('o', COMMON_DAO_Base::ORDER_NONE),
									$front->getRequest()->getParam('ctry'),
									$front->getRequest()->getParam('lg'),
									$front->getRequest()->getParam('mcs'),
									$front->getRequest()->getParam('ind'),
									$front->getRequest()->getParam('pr')
									); //first time
			// TODO Consider loading history from Database?
			// TODO On logout, save historY?
		} else {
			//	echo "nodeNS exits. pushing it."; exit;
			// TODO : Check if its a repeat of last history.
			$current_history = $this->current(True);
			$previous_history = $this->history1(True);
			
			if (	($front->getRequest()->getControllerName() <> $current_history[0]) |
					($front->getRequest()->getActionName() <> $current_history[1]) |
					($front->getRequest()->getParam('q') <> $current_history[2]) |
					($front->getRequest()->getParam('p') <> $current_history[3]) |
					($front->getRequest()->getParam('ps') <> $current_history[4]) |
					($front->getRequest()->getParam('f') <> $current_history[5]) |
					($front->getRequest()->getParam('o') <> $current_history[6]) |
					($front->getRequest()->getParam('ctry') <> $current_history[7]) |
					($front->getRequest()->getParam('lg') <> $current_history[8]) |
					($front->getRequest()->getParam('mcs') <> $current_history[9]) |
					($front->getRequest()->getParam('ind') <> $current_history[10]) |
					($front->getRequest()->getParam('pr') <> $current_history[11])
				) {
//				if ($front->getRequest()->getControllerName() <> $current_history[0]) { echo "Controller has Changed<br>";}	
//				if ($front->getRequest()->getActionName() <> $current_history[1]) { echo "Action has Changed<br>";}	
//				if ($front->getRequest()->getParam('q') <> $current_history[2]) { echo "Seach Query has Changed<br>";}	
//				if ($front->getRequest()->getParam('p') <> $current_history[3]) { echo "Page has Changed<br>";}	
//				if ($front->getRequest()->getParam('ps') <> $current_history[4]) { echo "Page Size has Changed<br>";}	
//				if ($front->getRequest()->getParam('f') <> $current_history[5]) { echo "Filter has Changed<br>";}	
//				if ($front->getRequest()->getParam('o') <> $current_history[6]) { echo "Order has Changed<br>";}	
				
					
					
//				echo "Push it<br>";
//				echo "Controllers Match : " . $front->getRequest()->getControllerName(). "-" . $current_history[0] . '<br>';	
//				echo "Action Match : " . $front->getRequest()->getActionName(). "-" . $current_history[1] . '<br>';	
//				var_dump( $current_history); echo "<br><br>";
//				var_dump( $previous_history); echo "<br><br>";
				$nodeNS->microhistory[] = array(
									$front->getRequest()->getControllerName(),
									$front->getRequest()->getActionName(),
									$front->getRequest()->getParam('q', ''),
									$front->getRequest()->getParam('p'),
									$front->getRequest()->getParam('ps'),
									$front->getRequest()->getParam('f'),
									$front->getRequest()->getParam('o'),
									$front->getRequest()->getParam('ctry'),
									$front->getRequest()->getParam('lg'),
									$front->getRequest()->getParam('mcs'),
									$front->getRequest()->getParam('ind'),
									$front->getRequest()->getParam('pr')
									); //first time
									}
//			echo "<br>Dump history<br>";
//			$this->dump();
//			exit;
			// If history count > 50, lets write to DB.			
		}

		if (empty($nodeNS->history)) {
			//	echo "nodeNS is empty"; exit;
			$nodeNS->history[] = array($front->getRequest()->getControllerName(), $front->getRequest()->getActionName()); //first time
			// TODO Consider loading history from Database?
			// TODO On logout, save historY?
		} else {
			//	echo "nodeNS exits. pushing it."; exit;
			// TODO : Check if its a repeat of last history.
			$current_history = $this->current();

			if (($front->getRequest()->getControllerName() <> $current_history[0]) || ($front->getRequest()->getActionName() <> $current_history[1])) {
//				echo "Controllers Match : " . $front->getRequest()->getControllerName(). "-" . $current_history[0] . '<br>';	
//				echo "Action Match : " . $front->getRequest()->getActionName(). "-" . $current_history[1] . '<br>';	
				$nodeNS->history[] = array($front->getRequest()->getControllerName(), $front->getRequest()->getActionName()); // Pushes values onto array.
			}
//			echo "<br>Dump history<br>";
//			$this->dump();
//			exit;
			// If history count > 50, lets write to DB.			
		}
		
		return true;
	}
	
	
	
	//Consider using current(), end(), next(), reset() etc.. for array management
	public function current( $micro=False){
		$nodeNS = new Zend_Session_Namespace('Node');

		if ($micro) {
			end($nodeNS->microhistory);		
			return current($nodeNS->microhistory);
		} else {
			end($nodeNS->history);		
			return current($nodeNS->history);
		}

	}
	
	public function history1($micro=False){
		$nodeNS = new Zend_Session_Namespace('Node');

		if ($micro) {
			end($nodeNS->microhistory);		
			prev($nodeNS->microhistory);	
			return current($nodeNS->microhistory);
		} else {
			end($nodeNS->history);
			prev($nodeNS->history);	
			return current($nodeNS->history);
		}
	}

	public function history2($micro=False){
		$nodeNS = new Zend_Session_Namespace('Node');

		if ($micro) {
			end($nodeNS->microhistory);		
			prev($nodeNS->microhistory);	
			prev($nodeNS->microhistory);	
			return current($nodeNS->microhistory);
		} else {
			end($nodeNS->history);
			prev($nodeNS->history);	
			prev($nodeNS->history);	
			return current($nodeNS->history);
		}
	}
	
	public function history3($micro=False){
		$nodeNS = new Zend_Session_Namespace('Node');

		if ($micro) {
			end($nodeNS->microhistory);		
			prev($nodeNS->microhistory);	
			prev($nodeNS->microhistory);	
			prev($nodeNS->microhistory);	
			return current($nodeNS->microhistory);
		} else {
			end($nodeNS->history);
			prev($nodeNS->history);	
			prev($nodeNS->history);	
			prev($nodeNS->history);	
			return current($nodeNS->history);
		}
	}
	
	
	public function previous($micro=False){
		$nodeNS = new Zend_Session_Namespace('Node');
		
	}
	
	public function dump($micro=False){
		$nodeNS = new Zend_Session_Namespace('Node');

		
		if ($micro) {
			foreach ($nodeNS->history as $history) {
				echo "History : " . $history[0] . '-' . $history[1] . '- q:' . $history[2] . '- p:' . $history[3] . '- ps:' . $history[4] . '- f:' . $history[5] . '- o:' . $history[6] . '<br>';
			}
		} else {
			foreach ($nodeNS->history as $history) {
				echo "MicroHistory : " . $history[0] . '-' . $history[1] . '- q:' . $history[2] . '- p:' . $history[3] . '- ps:' . $history[4] . '- f:' . $history[5] . '- o:' . $history[6] . '<br>';
			}
		}
		return $nodeNS->history;
	}
	
	
	public function flush($micro=False){
		// Clear the history trail
		
	}
	
	
	
}

