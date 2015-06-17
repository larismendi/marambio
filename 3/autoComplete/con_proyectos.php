<?php
	
	// PHP5 Implementation - uses MySQLi.
	// mysqli('localhost', 'yourUsername', 'yourPassword', 'yourDatabase');
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
				// Run the query: We use LIKE '$queryString%'
				// The percentage sign is a wild-card, in my example of countries it works like this...
				// $queryString = 'Uni';
				// Returned data = 'United States, United Kindom';
				
				// YOU NEED TO ALTER THE QUERY TO MATCH YOUR DATABASE.
				// eg: SELECT yourColumnName FROM yourTable WHERE yourColumnName LIKE '$queryString%' LIMIT 10
				$query = $db->query("SELECT t.IdTarea, t.CodificacionComp, g.Nombre AS Grupo, e.Nombre AS Empresa FROM tareas AS t LEFT JOIN grupos AS g ON t.IdGrupo = g.IdGrupo LEFT JOIN empresas AS e ON t.IdEmpresa = e.CodEmp WHERE t.CodificacionComp LIKE '$queryString%' OR g.Nombre LIKE '$queryString%' OR e.Nombre LIKE '$queryString%' ORDER BY t.CodificacionComp DESC LIMIT 10");
				if($query) {
					// While there are results loop through them - fetching an Object (i like PHP5 btw!).
					while ($result = $query ->fetch_object()) {
						// Format the results, im using <li> for the list, you can change it.
						// The onClick function fills the textbox with the result.
						
						// YOU MUST CHANGE: $result->value to $result->your_colum
						$idTarea = $result->IdTarea;
						$codigo = $result->CodificacionComp;
						$grupo = utf8_encode($result->Grupo);
						$empresa = utf8_encode($result->Empresa);
	         			echo '<li onClick="fill2(\''.$idTarea.'\');">'.$codigo.'-'.$grupo.'/'.$empresa.'</li>';
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