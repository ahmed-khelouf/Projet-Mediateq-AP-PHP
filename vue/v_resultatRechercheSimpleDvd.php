<h2>Disques DVD : </h2>
<div class="container-fluid">
    <?php
    foreach ($disques as $unDvd) {
    ?>
        <div class="row justify-content-center">
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-horizontal">
                        <div class="card-body text-center">
                            <h4 class="card-title mb-3"><strong><?= $unDvd->getTitre() ?></strong></h4>
                            <div class="img-square-wrapper mx-auto ">
                                <img class="img-fluid d-block" src="images/DVD/<?= $unDvd->getImage() ?>.jpg" alt="<?= $unDvd->getTitre() ?>">
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li>
                                    <p class="card-text "><strong> Synopsis :</strong> <?= $unDvd->getSynopsis() ?></p>
                                    <p style="margin-bottom: 2px;"></p>
                                </li>
                                <li>
                                    <p class="card-text"><strong>Auteur :</strong> <?= $unDvd->getRealisateur() ?></p>
                                </li>
                                <li>
                                    <p class="card-text"><strong>Durée :</strong> <?= $unDvd->getDuree() ?> min</p>
                                </li>
                                <li>
                                    <p class="card-text "><strong>Public :</strong> <?= $unDvd->getTypePublic()->getLibelle() ?></p>
                                </li>
                            </ul>
                            <!-- redirection dans une page qui affiche les exemplaires du dvd en question -->
                            <a href="index.php?action=dvd&id=<?= $unDvd->getId() ?>" class="btn btn-primary">Voir plus</a>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?php
                        $txtExemplaires = "Aucun exemplaires";
                        $txtRayons = "";
                        $nbExemplaires = count($unDvd->getLesExemplaires());
                        if ($nbExemplaires > 0) {
                            $txtRayons = "Rayon";
                            $txtExemplaires = $nbExemplaires . " exemplaire";
                            $finTxt = " : ";
                            if ($nbExemplaires > 1) {
                                $finTxt = "s : ";
                            }
                            $txtRayons .= $finTxt;
                            $txtExemplaires .= $finTxt;

                            foreach ($unDvd->getLesExemplaires() as $unExemplaire) {
                                $txtRayons .= $unExemplaire->getLeRayon() . ", ";
                            }
                            $txtRayons = substr($txtRayons, 0, -2);
                        } ?>
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