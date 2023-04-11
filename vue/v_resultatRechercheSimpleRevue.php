<h2>Revues : </h2>
<div class="container-fluid">
    <?php
    // Pour chaque revue dans la liste $uneRevue
    foreach ($revues as $uneRevue) {
    ?>
        <div class="row justify-content-center">
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-horizontal">
                        <div class="img-square-wrapper">
                            <!-- Affichage de l'image -->
                            <img class="img-fluid mx-auto d-block" src="images/logo/<?= $uneRevue->getLogo() ?>.jpg" alt="<?= $uneRevue->getTitre() ?>" width="500" height="500">
                        </div>
                        <div class="card-body">
                            <!-- Affichage du titre -->
                            <h4 class="card-title mb-3"><strong><?= $uneRevue->getTitre() ?></strong></h4>
                            <ul class="list-unstyled mb-4">
                                <!-- Affichage information d'un revue -->
                                <li>
                                    <p class="card-text "><strong>Type de document :</strong> <?= $uneRevue->getDescripteur()->getLibelle() ?></p>
                                    <p style="margin-bottom: 2px;"></p>
                                </li>
                                <li>
                                    <p class="card-text "><strong>Périodicité :</strong> <?= $uneRevue->getPeriodicite() ?></p>
                                </li>
                            </ul>
                            <!-- si la revue est empruntable -->
                            <?php if ($uneRevue->getEmpruntable()) {
                                $txt = "Cette revue est empruntable";
                            ?>
                                <p class="card-text text-danger"><strong><?= $txt ?></strong></p>
                                <!-- redirection dans une page qui affiche les parutions de la revue en question -->
                                <a href="index.php?action=revue&id=<?= $uneRevue->getId() ?>" class="btn btn-primary">Voir plus</a>
                                <?php
                                ?>
                            <?php } else {
                                $txt = "Cette revue n'est pas empruntable";
                            ?>
                                <p class="card-text text-danger"><strong><?= $txt ?></strong></p>
                                <?php
                                ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                            <?php
                            // Initialisation des variables
                            $txtNumeros = "Aucun numéros disponibles";
                            $nbNumeros = count($uneRevue->getLesNumeros());
                            // Si le nombre d'exemplaires est supérieur à zéro
                            if ($nbNumeros > 0) {
                                // Initialisation des textes
                                $txtNumeros = $nbNumeros . " numéro";
                                $finTxt = " : ";
                                // Si le nombre d'exemplaires est supérieur à 1, on rajoute un 's' à 'exemplaire'
                                if ($nbNumeros > 1) {
                                    $finTxt = "s : ";
                                }
                                $txtNumeros .= $finTxt;
                                // Pour chaque exemplaire d'une revue
                                foreach ($uneRevue->getLesNumeros() as $unNumero) {
                                    $txtNumeros .= $unNumero->getNumero() . " (" . $unNumero->getDateParution() . "), ";
                                }
                                // On enlève les deux derniers caractères de la variable $txtNumeros
                                $txtNumeros = substr($txtNumeros, 0, -2);
                            } ?>
                            <small class="text-muted">
                                <?= $txtNumeros ?>
                            </small>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>