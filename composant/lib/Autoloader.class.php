<?php

     function autoload($class) {
     	$aElems = explode("Vue", $class);
		if($aElems[0] != $class){
			include '../vues/' . $class . '.class.php';
		}else{
			$aElems = explode("Exception", $class);
			$aElems_ = explode("Lib", $class);
			if($aElems[0] != $class || $aElems_[0] != $class)
		    	include '../../composant/lib/' . $class . '.class.php';	    		
			else{
				include '../modeles/' . $class . '.class.php';
			}
		}		
	}
	 
	 function autoloadAjax($class) {
     	$aElems = explode("Vue", $class);
		if($aElems[0] != $class){
			include '../../vues/' . $class . '.class.php';
		}else{
			$aElems = explode("Exception", $class);
			$aElems_ = explode("Lib", $class);
			if($aElems[0] != $class || $aElems_[0] != $class)
		    	include '../../../composant/lib/' . $class . '.class.php';	    		
			else{
				include '../../modeles/' . $class . '.class.php';
			}
		}		
	}
	
?>