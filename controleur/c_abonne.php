<?php

// Inclusion du modèle et initialisation de l'objet manager
$abonneManager = new AbonneManager();

// Si l'utilisateur est connecté, récupérez ses informations à partir de la session
if(isset($_SESSION['mailU'])) {
    $unAbonne = $abonneManager->getUtilisateurByMailU($_SESSION['mailU']);
}

// Si le formulaire de modification de mot de passe est soumis
if(isset($_POST['id']) && isset($_POST['mdpU'])) {

    // Vérification du jeton CSRF
    if(isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

        $id = $_POST['id'];
        $mdpU = $_POST['mdpU'];

        // Mettre à jour le mot de passe de l'utilisateur
        $abonneManager->updateMdp($id, $mdpU);

        // Rediriger l'utilisateur vers la page de connexion
    } else {
        // Si le jeton CSRF est invalide, afficher une erreur ou rediriger l'utilisateur vers une page d'erreur
        // ...
		echo"Erreur session";
    }
}

// Générer un jeton CSRF unique
$csrf_token = bin2hex(random_bytes(32));

// Stocker le jeton CSRF en session
$_SESSION['csrf_token'] = $csrf_token;

// Inclusion de la vue
include "$racine/vue/header.php";
include "$racine/vue/v_monDossier.php";
include "$racine/vue/footer.php";