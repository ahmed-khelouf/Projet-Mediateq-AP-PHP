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

if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['dateNaissance']) && isset($_POST['adresse']) && isset($_POST['numTel']) && isset($_POST['typeAbonnement']) && isset($_POST['finAbonnement']) && isset($_POST['mdpU']) && isset($_POST['mailU'])) {
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$dateNaiss = $_POST['dateNaissance'];
	$adresse = $_POST['adresse'];
	$numTel = $_POST['numTel'];
	$finAbo = $_POST['finAbonnement'];
	$mdpU = $_POST['mdpU'];
	$mailU = $_POST['mailU'];
	$typeAbonnement = $_POST['typeAbonnement'];

	$abonneManager->insertAbo($nom, $prenom, $dateNaiss, $adresse, $numTel, $finAbo, $mdpU, $mailU, $typeAbonnement);
}
// Inclusion de la vue
include "$racine/vue/header.php";
include "$racine/vue/v_monDossier.php";
include "$racine/vue/footer.php";