<?php


/**
 * Useful string generator
 * - used for brute force dictionary creation
 * - not suitable for random password generation
 *
 * Example Usage
 * ---------------------------------------------------------------------
 * for($j = 1; $j <= 100000; $j++) {
 * 		echo $j . ' : ' . $string_gen->genSerialString($j) . '<br>';
 * 		$dao = array();
 * 		$dao['word'] = $string_gen->genSerialString($j);
 * 		$dao->insertData($dao);
 * }
 *
 */
class COMMON_Utility_StringGenerator {
	const ALPHANUMERIC_MAX = 36;


	public function __contruct(){

	}

	// -------------------------------------------------------------------------------
	// String Character Generation Functions
	// -------------------------------------------------------------------------------

	/**
	 *  genSerialString generates strings incrementally.
	 *  - good for brute force dictionary attacks 
	 * @param $string_counter
	 * @return unknown_type
	 */
	public function genSerialString($string_counter = 0){
		$power = 0;
//		$division = 10000;
		$division = $string_counter;
		$generated_string = '';
		
		while (pow(self::ALPHANUMERIC_MAX, $power) <= $division){
			$power++;
		}
//		echo "Power :" . $power . '<br>';  // Character count is the power

		for($i = $power; $i >= 1; $i--) {
			$division = $division / pow(self::ALPHANUMERIC_MAX, ($i-1));
			$remainder = $string_counter % pow(self::ALPHANUMERIC_MAX, ($i-1));
//			echo "Division :" . $division . '<br>';
//			echo "Remainder :" . $remainder . '<br>';
			$generated_string .= $this->getAlphaNumeric(intval($division));
//			echo "Generated String : " . $generated_string;
			$division = $remainder;
		}
//		exit;
		return $generated_string;
	}
	
	
	public function genRandomString($string_length = 1)
	{
		if($string_length>0)
		{
			$generated_string = "";
			for($i = 1; $i <= $string_length; $i++) {
				mt_srand((double)microtime() * 1000000);
				$generated_string .= $this->getAlphaNumeric(mt_rand(1, self::ALPHANUMERIC_MAX));
			}
		}
		return $generated_string;
	}

	// -------------------------------------------------------------------------------
	// Single Character Generation Functions
	// -------------------------------------------------------------------------------
	public function getAlphaNumeric($id)
	{
		$character = '';
		// accepts 1 - 36
		switch($id) {
			case "1":
				$character = "a";
				break;
			case "2":
				$character = "b";
				break;
			case "3":
				$character = "c";
				break;
			case "4":
				$character = "d";
				break;
			case "5":
				$character = "e";
				break;
			case "6":
				$character = "f";
				break;
			case "7":
				$character = "g";
				break;
			case "8":
				$character = "h";
				break;
			case "9":
				$character = "i";
				break;
			case "10":
				$character = "j";
				break;
			case "11":
				$character = "k";
				break;
			case "12":
				$character = "l";
				break;
			case "13":
				$character = "m";
				break;
			case "14":
				$character = "n";
				break;
			case "15":
				$character = "o";
				break;
			case "16":
				$character = "p";
				break;
			case "17":
				$character = "q";
				break;
			case "18":
				$character = "r";
				break;
			case "19":
				$character = "s";
				break;
			case "20":
				$character = "t";
				break;
			case "21":
				$character = "u";
				break;
			case "22":
				$character = "v";
				break;
			case "23":
				$character = "w";
				break;
			case "24":
				$character = "x";
				break;
			case "25":
				$character = "y";
				break;
			case "26":
				$character = "z";
				break;
			case "27":
				$character = "0";
				break;
			case "28":
				$character = "1";
				break;
			case "29":
				$character = "2";
				break;
			case "30":
				$character = "3";
				break;
			case "31":
				$character = "4";
				break;
			case "32":
				$character = "5";
				break;
			case "33":
				$character = "6";
				break;
			case "34":
				$character = "7";
				break;
			case "35":
				$character = "8";
				break;
			case "36":
				$character = "9";
				break;
		}
		return $character;
	}

	public function getAlpha($id){


	}

	public function getNumeric($id){

	}




}

?>