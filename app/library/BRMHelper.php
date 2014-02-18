<?php

class BRMHelper{
	public static function printR($string) {
                echo '<pre>';

				print_r($string);
                echo '</pre>';
	}

	public static function slashDate($date) {
		$datex = strtotime($date);
		return date('d/m/Y', $datex);
	}

	public static function createSlug($string, $force_lowercase = true, $anal = false) {

	    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "=", "+", "[", "{", "]", "_",
	                   "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
	                   "â€”", "â€“", ",", "<", ".", ">", "/", "?");
	    $clean = trim(str_replace($strip, "", strip_tags($string)));
	    $clean = preg_replace('/\s+/', "_", $clean);
	    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
	    return ($force_lowercase) ?
	        (function_exists('mb_strtolower')) ?
	            mb_strtolower($clean, 'UTF-8') :
	            strtolower($clean) :
	        $clean;
	}
	
	public static function genRandomPassword(){
		$A_Z = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789!@#$%&';
		$ret = '';
		for($ctr=0; $ctr<6; $ctr++){
			$ret .= $A_Z[rand(0,35)];
		}		
		return $ret;
	}

	public static function genRandomTransactionId(){
		$A_Z = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
		$ret = '';
		for($ctr=0; $ctr<15; $ctr++){
			$ret .= $A_Z[rand(0,strlen($A_Z) - 1)];
		}
		return $ret;
	}
	        
}