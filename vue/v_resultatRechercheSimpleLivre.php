<h2>Livres : </h2>
<div class="container-fluid">
    <?php

    foreach ($livres as $unLivre) {
    ?>

        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-horizontal">
                        <div class="img-square-wrapper">
                            <img class="" src="images/Livres/<?= $unLivre->getImage() ?>.jpg" alt="<?= $unLivre->getTitre() ?>">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><?= $unLivre->getId() ?></h4>
                            <h4 class="card-title"><?= $unLivre->getTitre() ?></h4>
                            <p class="card-text"><?= $unLivre->getISBN() ?></p>
                            <p class="card-text"><?= $unLivre->getAuteur() ?></p>
                            <p class="card-text"><?= $unLivre->getCollection() ?></p>
                            <!-- redirection dans une page qui affiche les exemplaires du livre en question -->
                            <a href="index.php?action=livre&id=<?= $unLivre->getId() ?>">Voir plus</a>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?php
                        $txtExemplaires = "Aucun exemplaires";
                        $txtRayons = "";
                        $nbExemplaires = count($unLivre->getLesExemplaires());
                        if ($nbExemplaires > 0) {
                            $txtRayons = "Rayon";
                            $txtExemplaires = $nbExemplaires . " exemplaire";
                            $finTxt = " : ";
                            if ($nbExemplaires > 1) {
                                $finTxt = "s : ";
                            }
                            $txtRayons .= $finTxt;
                            $txtExemplaires .= $finTxt;

                            foreach ($unLivre->getLesExemplaires() as $unExemplaire) {
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