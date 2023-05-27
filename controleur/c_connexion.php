<?php
$empruntManager = new empruntExemplaireManager();
$empruntParutionManager = new EmpruntParutionManager();

$empruntManager->updateFraisDeRetard();
$empruntManager->updateProlongeable();
$empruntParutionManager->updateFraisDeRetard();
$empruntParutionManager->updateProlongeable();

$connexionManager = new ConnexionManager();
$dateConnexionManager = new DateConnexionManager();

$abonneManager = new abonneManager();
$abonnes = $abonneManager->getList();

// Vérifier si le formulaire de connexion a été soumis
if (isset($_POST["mailU"]) && isset($_POST["mdpU"])) {
    $mailU = $_POST["mailU"];
    $mdpU = $_POST["mdpU"];

    // Vérifier les identifiants de connexion et récupérer le token
    $token = $connexionManager->login($mailU, $mdpU);

    if (!is_null($token)) {
        // Stocker le token dans une variable de session pour une utilisation ultérieure
        $_SESSION["token"] = $token;

        // Enregistrer la date de connexion
        $idUtilisateur = $abonneManager->getUtilisateurByMailU($mailU);
        $dateConnexion = date('Y-m-d H:i:s');
        $dateConnexionManager->historiserConnexion($idUtilisateur->getId(), $dateConnexion);
    }
}

// Vérifier si l'utilisateur est connecté et si le token est valide
if ($connexionManager->isLoggedOn() && isset($_SESSION["token"]) && $_SESSION["token"] === $token) {
    include "$racine/vue/v_accueil.php";
} else {
    include "$racine/vue/header.php";
    include "$racine/vue/v_connexion.php";
    include "$racine/vue/footer.php";
}

// Si l'utilisateur est connecté, rediriger vers le contrôleur monProfil
if ($connexionManager->isLoggedOn() && isset($_SESSION["token"]) && $_SESSION["token"] === $token) {
    include "$racine/controleur/c_abonne.php";
}
