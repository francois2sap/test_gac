<?php
	$mysqli = new mysqli("localhost", "root","", "db_gac");

	if ($mysqli->connect_error){
		die('Erreur de connexion (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
	}

	if ($mysqli->query("TRUNCATE `appels`") === FALSE){
		echo("Truncate NOT OK.\n");
	}

	if (!$mysqli->set_charset('latin1')){
		printf("Erreur lors du chargement du jeu de caractères latin1 : %s\n", $mysqli->error);
	exit();
	}

	$row = 1;

	if (($handle = fopen('C:/wamp64/tmp/tickets_appels_201202.csv', "r")) !== FALSE){
		while (($data = fgetcsv($handle, 1000, ";")) !== FALSE){     
			$num = count($data);

			$row++;
	
			$num_compte = $mysqli->real_escape_string($data[0]);
		
			$num_fac = $mysqli->real_escape_string($data[1]);
		
			$num_abo = $mysqli->real_escape_string($data[2]);
		
			$date = date_parse_from_format('d/m/Y', $data[3]);
		
			if (checkdate ($date['month'], $date['day'], $date['year']) == FALSE){
				echo "Date incorrect : '$data[3]', Ligne $row <br>";
				continue;
    	}
     		
			$date_tab = $mysqli->real_escape_string($date['year'].'-'.$date['month'].'-'.$date['day']);
		
			if (strlen($data[4]) == 0){
				echo "Heure incorrect, non specifiee, Ligne $row <br>";
				continue;
			}
		
			if (strtotime($data[4]) === false){
				echo "Heure incorrect : '$data[4]', Ligne $row <br>";
				continue;
			}
    
    	$heure = $mysqli->real_escape_string($data[4]);
    
    	if (strpos($data[5], ":") === false){
				$temps_appel = $mysqli->real_escape_string($data[5]);
			} 
		
			else {
				list($hour, $min, $sec) = explode(":", $data[5]);
			$temps_appel = $mysqli->real_escape_string((($hour * 3600) + ($min * 60) + $sec));
    	}
		
			if (empty ($temps_appel)){
				$temps_appel = '0';
			}
        	
			if (strpos($data[6], ":") === false){
				$temps_facture = $mysqli->real_escape_string($data[6]);
			} 
		
			else {
				list($hour, $min, $sec) = explode(":", $data[6]);
				$temps_facture = $mysqli->real_escape_string((($hour * 3600) + ($min * 60) + $sec));
			}
		
			if (empty ($temps_facture)){
				$temps_facture = '0';
			}

			$type = $mysqli->real_escape_string($data[7]);

			$query = "INSERT INTO `appels` (`num_compte`, `num_fac`, `num_abo`, `date`, `heure`, `temps_appel`, `temps_facture`, `type`) VALUES ('$num_compte', '$num_fac', '$num_abo', '$date_tab', '$heure', '$temps_appel','$temps_facture', '$type')";
 			
			if ($mysqli->query($query) === FALSE){
				echo("$query Insert NOT OK." . $mysqli->error . " " . $mysqli->errno);
			}
		}
	fclose($handle);
	$mysqli->close();
	}
?>