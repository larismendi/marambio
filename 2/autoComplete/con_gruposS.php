<?php
	$db = new mysqli('localhost', 'root' ,'', 'marambio2');
	
	if(!$db) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {
		// Is there a posted query string?
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);
			
			if(strlen($queryString) >0) {
				$query = $db->query("SELECT Nombre FROM grupos WHERE Nombre LIKE '$queryString%'");
				if($query) {
					// While there are results loop through them - fetching an Object (i like PHP5 btw!).
					while ($result = $query ->fetch_object()) {
						
						$nombrei = utf8_encode($result->Nombre);
	         			echo '<li onClick="fillGroup(\''.$nombrei.'\');">'.$nombrei.'</li>';

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