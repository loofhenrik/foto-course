<?php
	function redirect_to($location = NULL){
		if($location != NULL){
			header("Location: {$location}");
			exit;
		}
	}

	function validate_presence($require_fields = []){
        global $error;
    
        foreach($require_fields as $fieldname){
            $_POST[$fieldname] = trim($_POST[$fieldname]);      //trim tar bort mellanslag i början och i slutet sträng
            
                if(empty($_POST[$fieldname])){
                    $error .= "<li>Fyll i fält.</li>";
                }
        }
	}

	/*function confirm_query($result_set){
		if(!$result_set){
			die("unable to connect");
		}
	}*/
?>