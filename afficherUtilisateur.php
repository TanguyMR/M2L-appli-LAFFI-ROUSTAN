<?php //on utilise ici une autre stratégie que celle du routeur que vous avez vu en PPE1 pour uniformiser les pages de l'application. Il s'agit d'inclure sur chaque page du site des entetes et bas de page identiques 
	include ("header.php");

?>

<?php

$association = 0;
$pseudo = "pas de pseudo transmis";
$nom = "pas de nom transmis";
$prenom = "pas de prénom transmis";
$statut = "";
$image = "";
$email = "";
$avatar ="";
$civilite ="";
$newsletter = 0;
$motdePasse ="";
$DatedeNaissance = "";

if (isset($_GET['choix']) && $_GET['choix'] != ""){
	$asso = htmlentities($_GET['choix']);
	$SQL1 = "SELECT libelleAssociation, imageAssociation, descriptionAssociation FROM association WHERE idAssociation = ". $asso;
	$resultats=$connexion->query($SQL1); // on execute notre requête
	$resultats->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet
	$ligne = $resultats->fetch();
	$description = $ligne->descriptionAssociation;
	$image = "images/associations/".$ligne->imageAssociation;
	$libelleAsso = $ligne->libelleAssociation;
	$resultats->closeCursor(); // on ferme le curseur des résultats*/
}

if (isset($_POST['pseudo']) && $_POST['pseudo'] != ""){
	$pseudo = htmlentities($_POST['pseudo']);
}
if (isset($_POST['nom']) && $_POST['nom'] != ""){
	$nom = htmlentities($_POST['nom']);
}
if (isset($_POST['prenom']) && $_POST['prenom'] != ""){
	$prenom = htmlentities($_POST['prenom']);
}
if (isset($_POST['statut'])&& $_POST['statut'] != ""){
	$statut = htmlentities($_POST['statut']);
}
if (isset($_POST['email']) && $_POST['email'] != ""){
	$email = htmlentities($_POST['email']);
}
if (isset($_POST['pays']) && $_POST['pays'] != ""){
	$pays = htmlentities($_POST['pays']);
}
if (isset($_POST['civilite']) && $_POST['civilite'] != ""){
	$civilite = htmlentities($_POST['civilite']);
}
if (isset($_POST['mdp'])&& $_POST['mdp'] != ""){
	$motdePasse = htmlentities($_POST['mdp']);
}
if (isset($_POST['newsletter']) && $_POST['newsletter'] != ""){
	$newsletter = htmlentities($_POST['newsletter']);
}
if (isset($_POST['avatar'])&& $_POST['avatar'] != ""){
	$avatar = htmlentities($_POST['avatar']);
}
if (isset($_POST['age'])&& $_POST['age'] != ""){
	$DatedeNaissance = htmlentities($_POST['age']);
}


$req = $connexion->prepare('INSERT INTO utilisateur (pseudo, nom, prenom, adresseMail, motPasse, idAssociation, idStatut, idPays, idCivilite, idAvatar, newsletter, dateNaissance) 
VALUES (:pseudo, :nom, :prenom, :email, :motdePasse, :asso, :statut, :pays, :civilite, :avatar, :newsletter, :dateNaissance)');
//$req2 = 'INSERT INTO utilisateur (pseudo, nom, prenom, idAssociation, idStatut) VALUES("'.$pseudo.'","'.$nom.'","'.$prenom.'", '.$asso.','.$statut.')';
//echo $req2;

$resultat = $req->execute(array(
    'pseudo' => $pseudo,
	'nom' => $nom,
	'prenom' => $prenom,
    'asso' => $asso,
	'statut' => $statut,
	'email' => $email,
	'motdePasse' => $motdePasse,
	'pays' => $pays,
	'civilite' => $civilite,
	'avatar' => $avatar,
	'newsletter' => $newsletter,
	'dateNaissance' => $DatedeNaissance
    ));

?>
<?php if ($resultat) { ?>
<div class="d-flex justify-content-center">
    <div class="col-md-4"><img class="rounded mx-auto d-block" src="<?php echo $image; ?>" height="200" width="300" /></div>

    <div class="col-md-4">
        <div class="text-center">

        <div class="card">
		
	<h1 class="card-header">Affichage de la fiche</h1>
	
	<div class="card-body">



		<h5 class="card-title"><div class="alert alert-success">Fiche bien enregistrée pour l'association </div></h5>
			<p class="card-text">
					<ul class="list-group list-group-flush ">

						<li class="list-group-item"><b> Pseudo: </b>
						<?php echo $pseudo; ?>
						</li>

						<li class="list-group-item"><b> Mot de Passe: </b>
						<?php echo $motdePasse; ?>
						</li>

						<li class="list-group-item"><b> Nom: </b>
						<?php echo $nom; ?>
						</li>

						<li class="list-group-item"><b> Prénom: </b>
						<?php echo $prenom; ?>
						</li>

						<li class="list-group-item"><b> Email: </b>
						<?php echo $email; ?>
						</li>

						

						<li class="list-group-item"><b> Association: </b>
						<?php
							$SQL = "SELECT libelleAssociation FROM `association` WHERE idAssociation = ".$asso." ;";
							$resultats=$connexion->query($SQL); // on execute notre requête
							$resultats->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet
							$ligne = $resultats->fetch();
							$libelledeAssociation = $ligne->libelleAssociation;			
							$resultats->closeCursor(); // on ferme le curseur des résultats*/
						?>
						<?php echo $libelledeAssociation; ?>

						<?php
							$SQL = "SELECT libelleStatut FROM statut WHERE idStatut = ".$statut." AND idAssociation = ".$asso.";";
							$resultats=$connexion->query($SQL); // on execute notre requête
							$resultats->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet
							$ligne = $resultats->fetch();
							$libelleStatut = $ligne->libelleStatut;			
							$resultats->closeCursor(); // on ferme le curseur des résultats*/
						?>
						</li>

						<li class="list-group-item"><b> Statut :</b>
						<?php echo $libelleStatut; ?>
						</li>

					</ul>
       		 </p>
    <a href="index.php" class="btn btn-primary">Retour</a>

  </div>
</div>


        </div>
    </div>

    <div class="col-md-4"><img class="rounded mx-auto d-block" src="<?php echo $image; ?>" height="200" width="300" /></div>

</div>

<?php }  else{ 
		echo "<div class=\"alert alert-danger\">";
		echo  "<strong>Erreur</strong> La fiche n'a pas pu être enregistrée";
		echo  "</div>";
	
	 } ?>

<div class="col-md-12 stoppad"> <?php 
	include ("footer.php");
?> </div>

