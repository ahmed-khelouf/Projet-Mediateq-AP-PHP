
<?php
$idRevue = $_GET['id'];
$revueManager = new RevueManager();
$uneRevue = $revueManager->getRevueById($idRevue);


// inclure la vue en lui transmettant les données nécessaires
include "$racine/vue/header.php";
include "$racine/vue/v_parution.php";
include "$racine/vue/footer.php";

?>