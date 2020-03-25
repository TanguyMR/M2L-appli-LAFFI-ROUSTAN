<?php //on utilise ici une autre stratégie que celle du routeur que vous avez vu en PPE1 pour uniformiser les pages de l'application. Il s'agit d'inclure sur chaque page du site des entetes et bas de page identiques 
	include ("header.php");

?>
	
    <?php if (isset($_GET['choix'])){
		$asso = htmlentities($_GET['choix']);
		?>
		
		<?php
			$SQL1 = "SELECT imageAssociation, descriptionAssociation FROM association WHERE idAssociation = ". $asso;
			$resultats=$connexion->query($SQL1); // on execute notre requête
			$resultats->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet
			$ligne = $resultats->fetch();
			$description = $ligne->descriptionAssociation;
			$image = "images/associations/".$ligne->imageAssociation;
			$resultats->closeCursor(); // on ferme le curseur des résultats*/
		?>
		
<div class="contenu">
    <div class="col-md-4"><img class="rounded mx-auto d-block" src="<?php echo $image; ?>" height="500" width="500"  /></div>

    <div class="col-md-4">
        <div class="text-center">

        <div class="card">
  <h1 class="card-header alert alert-info"><?php echo $description; ?></h1>

  <div class="card-body">
           <p class="card-text">
            <form method="post" id="saisie" name="saisie" action="afficherUtilisateur.php?choix=<?php echo $asso; ?>">
                <ul class="list-group list-group-flush ">

                    <li class="list-group-item"><label for="civilite">Civilité: </label> <br>
				<?php
							$SQL3 = "SELECT * FROM `civilite`";
							$resultats=$connexion->query($SQL3); // on execute notre requête
							$resultats->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet
							while ($ligne = $resultats->fetch()){
								echo '<input class="form-check-label" type="radio" id="civilite" name="civilite" value="'.$ligne->idCivilite.'" checked> 
								<label for="civilite">'.$ligne->libelleCivilite.'</label> <br>';
							}		
							$resultats->closeCursor(); // on ferme le curseur des résultats*/
				?>
                    
                    </li>

                    <li class="list-group-item"><label for="nom">Quel est votre  nom ?</label>
				<textarea rows="1" class="form-control form-control-lg text-center" id="nom" name="nom" oninput="verifNom()"></textarea> <span id="SurligneNom"> </span>
                    </li>

                    <li class="list-group-item"><label for="nom">Quel est votre prénom ?</label>
				<textarea rows="1" class="form-control form-control-lg text-center" id="prenom" name="prenom" oninput="verifPrenom()"></textarea> <span id="SurlignePrenom"> </span>
                    </li>

                    <li class="list-group-item"><label for="age">Quel est votre date de naissance ?</label>
				<input class="form-control form-control-lg text-center" type="date" id="age" name="age" value="2000-01-01" min="1900-01-01" max="2021-01-01">
                    </li>
                    
                    <li class="list-group-item"><label for="email">Quel est votre adresse mail ?</label> <br> <span id="SurligneEmail"> </span>
				<input class="form-control form-control-lg text-center" name="email" id="email" type="email" oninput="verifEmail()"/>
                    </li>

                    <li class="list-group-item"><label for="pseudo">Quel est votre pseudo ?</label><br> <span id="SurlignePseudo"> </span>
				<input class="form-control form-control-lg text-center" name="pseudo" id="pseudo" type="text" oninput="verifPseudo()" />
                    </li>

                    <li class="list-group-item"><label for="mdp">Quel est votre mot de passe ?</label> <br> <span id="SurligneMdp"> </span>
				<input class="form-control form-control-lg text-center" name="mdp" id="mdp" type="password" oninput="verifMdp()"/>
                    </li>

                    <li class="list-group-item"><label for="cmdp">Confirmer votre mot de passe ?</label><br> <span id="SurligneCmdp"> </span>
				<input class="form-control form-control-lg text-center" name="cmdp" id="cmdp" type="password" oninput="verifCmdp()" />
                    </li>

                    <li class="list-group-item"><label for="pays">Selectionner votre pays :</label>
					<select class="form-control form-control-lg" name="pays" id="pays">
					<?php
						$SQL3 = "SELECT idPays, libellePays FROM pays ORDER by libellePays";
						$resultats=$connexion->query($SQL3); // on execute notre requête
						$resultats->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet
						while ($ligne = $resultats->fetch()){
							echo '<option value="'.$ligne->idPays.'">'.$ligne->libellePays.'</option>';
						}		
						$resultats->closeCursor(); // on ferme le curseur des résultats*/
					?>
					</select>
                    </li>

                    <li class="list-group-item"><label for="camp">Quel est votre statut ?</label>
					<select name="statut" id="statut" class="form-control form-control-lg text-center">
						<?php
							$SQL2 = "SELECT idStatut, libelleStatut FROM association A JOIN statut S ON A.idAssociation = S.idAssociation WHERE S.idAssociation =".$asso;
							$resultats=$connexion->query($SQL2); // on execute notre requête
							$resultats->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet
							while ($ligne = $resultats->fetch()){
								echo '<option value="'.$ligne->idStatut.'">'.$ligne->libelleStatut.'</option>';
							}		
							$resultats->closeCursor(); // on ferme le curseur des résultats*/
						?>
					</select>
                    </li>

                    <li class="list-group-item"><label for="avatar">Choisir un avatar :</label><br>
					<?php
						$SQL5 = "SELECT idAvatar, lienImage FROM galerieavatar";
						$resultats=$connexion->query($SQL5); // on execute notre requête
						$resultats->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet
						while ($ligne = $resultats->fetch()){
							echo '<label><input class="form-check-label" name="avatar" id="avatar" type="radio" value="'.$ligne->idAvatar.'" checked/><img src="'.$ligne->lienImage.'" alt="Image de l\'avatar"/></label>';
						}		
						$resultats->closeCursor(); // on ferme le curseur des résultats   */
					?>
                    </li>

                    <li class="list-group-item"><div>
						<input class="form-check-label text-center" type="checkbox" id="newsletter" name="newsletter" value="1">
						<label for="newsletter">Souhaitez-vous vous abonner à la newsletter ?</label>
					</div>
			<br/>
                    </li>


                </ul>
               <button id="submit" type="submit" class="btn btn-primary btn-block" >Enregistrer et afficher la fiche utilisateur</button>
			   <span id="error"> </span>
		</form>														
        </p>

  </div>
</div>


        </div>
    </div>

    <div class="col-md-4"><img class="rounded mx-auto d-block" src="<?php echo $image; ?>" height="500" width="500"  /></div>
</div>


<?php } 
		else {
		?>
		<div class="alert alert-danger">Vous devez faire un choix</div>
		<?php }?>
	</div>

	<div class="col-md-12 stoppad"> <?php 
	include ("footer.php");
?> </div>





<script type="text/javascript">

bloquer();

function verifNom()
{				
	var nom = $('#nom').val();
	exp = new RegExp("^[a-zA-ZÀ-ÿ]{1,}$");


	if (exp.test(nom))
	{       
		$('#SurligneNom').html('');  
		$('#nom').css('border','');
		debloquer();
		
	}
	else
	{
		$('#SurligneNom').html('Vous devez saisir au moins 1 caractères sans saisir de chiffres ni caractères spéciaux.');
		$('#SurligneNom').css('color','red');   
		$('#nom').css('border','2px solid red');
		bloquer();
		
	}		
}

function verifPrenom()
{				
	var prenom = $('#prenom').val();
	exp = new RegExp("^[a-zA-ZÀ-ÿ]{1,}$");
	if (exp.test(prenom))
	{       
		$('#SurlignePrenom').html('');  
		$('#prenom').css('border','');
		a1 = 1;
		debloquer();
		
	}
	else
	{
		$('#SurlignePrenom').html('Vous devez saisir au moins 1 caractères sans saisir de chiffres ni caractères spéciaux.');
		$('#SurlignePrenom').css('color','red');   
		$('#prenom').css('border','2px solid red');
		bloquer();
	}		
}


function verifPseudo() {
	var pseudo = $('#pseudo').val();
	exp = new RegExp("^[a-zA-Z1-9]{4,15}$");
	if (exp.test(pseudo))
	{
		$.post("pseudoTraitBDD.php", { ppseudo : pseudo }, function(test)
		{
			if(test == 1)
			{		
				$('#SurlignePseudo').html('Le pseudo est déjà pris veuillez en choisir un autre.');  
				$('#SurlignePseudo').css('color','red');
				$('#pseudo').css('border','2px solid red');
				$('#pseudo').css('color','red');
				bloquer();
			} 
			else  if(test == 2)
			{	
				$('#SurlignePseudo').html(''); 
				$('#pseudo').css('border','');
				$('#pseudo').css('color','');
				a2 = 1;
				debloquer();
			
			}

			
		});
	}
	else
	{
		$('#SurlignePseudo').html('Vous devez saisir un pseudo entre 4 caractères et 15 maximum sans caractères spéciaux.');	
		$('#SurlignePseudo').css('color','red');		
		$('#pseudo').css('border','2px solid red');	
		$('#pseudo').css('color','red');					
		bloquer();
	}
}



function verifEmail(){
	var email = $('#email').val();
	exp = new RegExp("^\\w+([\\.-]?\\w+)*@\\w+([\\.-]?\\w+)*(\\.\\w{2,3})+$");
	if(exp.test(email)){


		$.post("emailTraitBDD.php", { email : email },	function(test)
		{
					if(test == 1)
					{		
						$('#SurligneEmail').html('Cette adresse e-mail est déjà utilisée.');
						$('#SurligneEmail').css('color','red');
						$('#email').css('border','2px solid red');

						bloquer();
					} else  if(test == 2){	
						$('#SurligneEmail').html('L\'adresse email est valide.'); 
						$('#SurligneEmail').css('color','green');
						$('#email').css('border','');
						$('#email').css('background','');
						a3 = 1;
						debloquer();
						
					}			  
		});  
	}
	else
	{
		$('#SurligneEmail').html('Cette adresse e-mail doit être de la forme exemple@exemple.fr.');
		$('#SurligneEmail').css('color','red');
		$('#email').css('border','2px solid red');
		bloquer();
	}
}

function verifMdp() 
{
	var motdepasse = $('#mdp').val();
	exp = new RegExp("^(?=.*[0-9])(?=.*[a-z]).{6,}$");
	if (exp.test(motdepasse))
	{
		$('#SurligneMdp').html('');       
		$('#mdp').css('border','');
		$('#SurligneMdp').css('color','');
		a4 = 1;
		debloquer();
		
	}
	else
	{
		$('#SurligneMdp').html('Le mot de passe doit contenir au moins 6 caractères, des lettres et des chiffres.');   
		$('#SurligneMdp').css('color','red');    
		$('#mdp').css('border','2px solid red');
		bloquer();
	} 
}

function verifCmdp() 
{
	var motdepasse = $('#mdp').val();
	motdepasseconfirm = $('#cmdp').val();
	if (motdepasse == motdepasseconfirm) 
	{
		$('#SurligneCmdp').html('');       
		$('#cmdp').css('border','');
		$('#SurligneCmdp').css('color','');
		a5 = 1;
		debloquer();
		

	} 
	else 
	{
		$('#SurligneCmdp').html('Les mots de passe saisies ne correspondent pas.');       
		$('#cmdp').css('border','2px solid red');
		$('#SurligneCmdp').css('color','red');
		bloquer();
	}
}


function bloquer()
{

		
		$('#submit').prop("disabled", true);
		$('#error').html('Veuillez remplir correctement tous les champs.'); 
		$('#error').css('color','red');
}
function ddebloquer()
{

		
		$('#submit').prop("disabled", false);
		$('#error').html('Tous les champs ont bien été renseignés.'); 
		$('#error').css('color','green');
}

function debloquer()
{

		if (a1 + a2 + a3 + a4 + a5  == 5)
		{

		$('#submit').prop("disabled", false);
		$('#error').html('Tous les champs ont bien été renseignés.'); 
		$('#error').css('color','green');
		}
}

</script>
