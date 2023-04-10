<h2>Revues : </h2>
<div class="container-fluid">
    <?php
    foreach ($revues as $uneRevue) {
    ?>
        <div class="row justify-content-center">
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-horizontal">
                        <div class="img-square-wrapper">
                            <img class="img-fluid mx-auto d-block" src="images/logo/<?= $uneRevue->getLogo() ?>.jpg" alt="<?= $uneRevue->getTitre() ?>" width="500" height="500">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title mb-3"><strong><?= $uneRevue->getTitre() ?></strong></h4>
                            <ul class="list-unstyled mb-4">
                                <li>
                                    <p class="card-text "><strong>Type de document :</strong> <?= $uneRevue->getDescripteur()->getLibelle() ?></p>
                                    <p style="margin-bottom: 2px;"></p>
                                </li>
                                <li>
                                    <p class="card-text "><strong>Périodicité :</strong> <?= $uneRevue->getPeriodicite() ?></p>
                                </li>
                            </ul>
                            <?php if ($uneRevue->getEmpruntable()) {
                                $txt = "Cette revue est empruntable";
                                ?>
                                <p class="card-text text-danger"><strong><?= $txt ?></strong></p>
                                <a href="index.php?action=revue&id=<?= $uneRevue->getId() ?>" class="btn btn-primary">Voir plus</a>
                                <?php
                            ?>
                                <!-- redirection dans une page qui affiche les parutions de la revue en question -->
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
                            $txtNumeros = "Aucun numéros disponibles";
                            $nbNumeros = count($uneRevue->getLesNumeros());
                            if ($nbNumeros > 0) {
                                $txtNumeros = $nbNumeros . " numéro";
                                $finTxt = " : ";
                                if ($nbNumeros > 1) {
                                    $finTxt = "s : ";
                                }
                                $txtNumeros .= $finTxt;
                                foreach ($uneRevue->getLesNumeros() as $unNumero) {
                                    $txtNumeros .= $unNumero->getNumero() . " (" . $unNumero->getDateParution() . "), ";
                                }
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