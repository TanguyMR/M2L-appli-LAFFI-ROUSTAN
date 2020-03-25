<?php


function Lignes($requete){
	include("BDD/connectBdd.php");
	try
	{
		$connexion = new PDO('mysql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
	}
	catch(Exception $e)
	{
		echo 'erreur !';
		die();
	}
	$test=$connexion->query($requete); 
	// tri par ordre croissant
	return $test->rowcount();
}



if ($_POST)
{
	$pseudo = ($_POST['ppseudo']);
	$requete = "SELECT pseudo FROM utilisateur WHERE pseudo = '".$pseudo."' ";

	$Lignes = Lignes($requete);

	if	($Lignes > 0)
		{ echo 1; }
	else	
		{ echo 2; } 
}

?>