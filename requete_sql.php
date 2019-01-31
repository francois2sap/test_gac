<?php
	$mysqli = new mysqli("localhost", "root","", "db_gac");

	if ($mysqli->connect_error){
		die('Erreur de connexion (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
	}

	if (!$mysqli->set_charset('latin1')){
		printf("Erreur lors du chargement du jeu de caractères latin1 : %s\n", $mysqli->error);
		exit();
	}

	$query = "SELECT SUM(`temps_appel`) FROM `appels` WHERE date >= '2012-02-15'";
 	
 	$resultat_query = $mysqli->query($query);	
	
	if ($resultat_query === FALSE){
		echo("$query Query NOT OK." . $mysqli->error . " " . $mysqli->errno);
	} else {
		$row = $resultat_query->fetch_array(MYSQLI_NUM);
		if ($row === NULL) {
			echo "<br>error";
		} else {
			echo "La durée totale réelle des appels effectués après le 15/02/2012 est de  " .gmdate("H:i:s", (int)$row[0]) . " soit " . $row[0] . " secondes. <br>";
		}
		$resultat_query->free();
	}
	

	$query = "SELECT `temps_facture` FROM `appels` WHERE `heure` NOT BETWEEN '08:00:00' AND '18:00:00' ORDER BY `temps_facture` DESC LIMIT 10";

	$resultat_query = $mysqli->query($query);	
	
	if ($resultat_query === FALSE){
		echo("<br>$query Query NOT OK." . $mysqli->error . " " . $mysqli->errno);
	} else {
		echo "<br>TOP 10 temps facture en secondes hors 8:00-18:00 <br>";
		while (($row = $resultat_query->fetch_array(MYSQLI_NUM)) !== NULL) {
			echo $row[0] . '<br>';
		}
		$resultat_query->free();
	}


	$query = "SELECT COUNT( * ) FROM `appels` WHERE `temps_appel` = 0";
	
	$resultat_query = $mysqli->query($query);

	if ($resultat_query === FALSE){
		echo("<br>$query Query NOT OK." . $mysqli->error . " " . $mysqli->errno);
	} else {
		$row = $resultat_query->fetch_array(MYSQLI_NUM);
		echo "<br>Le Total des SMS envoyes est de : $row[0] <br>";
		$resultat_query->free();
	}

	$mysqli->close();
?>