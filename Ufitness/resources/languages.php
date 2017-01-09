<?php	
	function __($str, $lang = null){
 
		if ( $lang != null ){
 
			if ( file_exists('../i18n/'.$lang.'.php') ){
 
				include('../i18n/'.$lang.'.php');
				if ( isset($texts[$str]) ){
					$str = $texts[$str];
				}
			}
		}
 
		return $str;
	}
?>
