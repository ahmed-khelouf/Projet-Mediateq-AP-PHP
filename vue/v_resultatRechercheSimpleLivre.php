<h2>Livres : </h2>
<div class="container-fluid">
    <?php
    // Pour chaque livre dans la liste $unLivre
    foreach ($livres as $unLivre) {
    ?>
        <div class="row justify-content-center">
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-horizontal">
                        <div class="card-body text-center">
                            <!-- Affichage du titre -->
                            <h4 class="card-title mb-3"><strong><?= $unLivre->getTitre() ?></strong></h4>
                            <div class="img-square-wrapper mx-auto ">
                                <!-- Affichage de l'image -->
                                <img class="img-fluid d-block" src="images/Livres/<?= $unLivre->getImage() ?>.jpg" alt="<?= $unLivre->getTitre() ?>">
                            </div>
                            <ul class="list-unstyled mb-4">
                                <!-- Affichage information d'un livre -->
                                <li>
                                    <p class="card-text "><strong> Synopsis :</strong> <?= $unLivre->getSynopsis() ?></p>
                                    <p style="margin-bottom: 2px;"></p>
                                </li>
                                <li>
                                    <p class="card-text"><strong>Auteur :</strong> <?= $unLivre->getAuteur() ?></p>
                                </li>
                                <li>
                                    <p class="card-text "><strong>Collection :</strong> <?= $unLivre->getCollection() ?></p>
                                </li>
                                <li>
                                    <p class="card-text "><strong>ISBN :</strong> <?= $unLivre->getISBN() ?></p>
                                </li>
                                <li>
                                    <p class="card-text "><strong>Public :</strong> <?= $unLivre->getTypePublic()->getLibelle() ?></p>
                                </li>
                            </ul>
                            <!-- redirection dans une page qui affiche les exemplaire du livre en question -->
                            <a href="index.php?action=livre&id=<?= $unLivre->getId() ?>" class="btn btn-primary">Voir plus</a>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?php
                        // Initialisation des variables
                        $txtExemplaires = "Aucun exemplaires";
                        $txtRayons = "";
                        $nbExemplaires = count($unLivre->getLesExemplaires());
                        // Si le nombre d'exemplaires est supérieur à zéro
                        if ($nbExemplaires > 0) {
                            // Initialisation des textes
                            $txtRayons = "Rayon";
                            $txtExemplaires = $nbExemplaires . " exemplaire";
                            $finTxt = " : ";
                            // Si le nombre d'exemplaires est supérieur à 1, on rajoute un 's' à 'exemplaire'
                            if ($nbExemplaires > 1) {
                                $finTxt = "s : ";
                            }
                            $txtRayons .= $finTxt;
                            $txtExemplaires .= $finTxt;
                            // Pour chaque exemplaire d'un livre
                            foreach ($unLivre->getLesExemplaires() as $unExemplaire) {
                                $txtRayons .= $unExemplaire->getLeRayon() . ", ";
                            }
                            // On enlève les deux derniers caractères de la variable $txtRayons
                            $txtRayons = substr($txtRayons, 0, -2);
                        } ?>
                        <!-- Affichage du nombre d'exemplaires et de leur emplacement -->
                        <small class="text-muted">
                            <?= $txtExemplaires . " - " . $txtRayons ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>


    <?php
    }
    ?>

</div>