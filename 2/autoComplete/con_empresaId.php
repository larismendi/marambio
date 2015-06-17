<?php
	$db = new mysqli('localhost', 'root' ,'', 'marambio2');
	
	if(!$db) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {
		// Is there a posted query string?
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);
			
			// Is the string length greater than 0?
			
			if(strlen($queryString) >0) {
				// YOU NEED TO ALTER THE QUERY TO MATCH YOUR DATABASE.
				//query = $db->query("SELECT id, value FROM countries WHERE value LIKE '$queryString%' LIMIT 10");
				$query = $db->query("SELECT CodEmp, Nombre FROM empresas WHERE Nombre LIKE '$queryString%'");
				if($query) {
					while ($result = $query ->fetch_object()) {
						$nombrei = utf8_encode($result->Nombre);
	         			echo '<li onClick="fill(\''.$result->CodEmp.'\',\''.$nombrei.'\');">'.$nombrei.'</li>';
	         		}
				} else {
					echo 'ERROR: There was a problem with the query.';
				}
			} else {
				// Dont do anything.
			} // There is a queryString.
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>