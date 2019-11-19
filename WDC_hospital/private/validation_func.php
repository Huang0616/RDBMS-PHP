<?php
	function is_blank($string){
		if(!isset($string) || trim($string) === ''){
			return true;
		}else{
			return false;
		}
	}

	function lenth_less_than($string, $max){
		return strlen($string)<=$max?true:false;
	}

	function has_valid_date_format($value) {
	    $date_regex = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';
	    return preg_match($date_regex, $value) === 1;
	}
?>