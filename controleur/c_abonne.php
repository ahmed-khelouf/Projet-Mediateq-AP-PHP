<?php
// Inclusion du modèle et initialisation de l'objet manager
$abonneManager = new AbonneManager();

// Si l'utilisateur est connecté, récupérez ses informations à partir de la session
if(isset($_SESSION['mailU'])) {
	$unAbonne = $abonneManager->getUtilisateurByMailU($_SESSION['mailU']);
}

// Si le formulaire de modification de mot de passe est soumis
	if(isset($_POST['id']) && isset($_POST['mdpU'])) {
		$id = $_POST['id'];
		$mdpU = $_POST['mdpU'];
	

	// Mettre à jour le mot de passe de l'utilisateur
	$abonneManager->updateMdp($id, $mdpU);
	
	// Rediriger l'utilisateur vers la page de connexion
}

// Inclusion de la vue
include "$racine/vue/header.php";
include "$racine/vue/v_monDossier.php";
include "$racine/vue/footer.php";
