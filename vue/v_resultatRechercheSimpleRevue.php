<h2>Revues : </h2>
<div class="container-fluid">


    <?php
    foreach ($revues as $uneRevue) {
    ?>
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-horizontal">
                        <div class="img-square-wrapper">
                            <img class="" src="" alt="<?= $uneRevue->getTitre() ?>">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><?= $uneRevue->getTitre() ?></h4>
                            <?php
                            if ($uneRevue->getEmpruntable()) {
                                $txt = "Cette revue est empruntable";
                            ?>
                            <?php
                            } else {
                                $txt = "Cette revue n'est pas empruntable";
                            }
                            ?>
                            <p class="card-text">Type de document : <?= $uneRevue->getDescripteur()->getLibelle() ?></p>
                            <p class="card-text"><?= $txt ?></p>

                            <?php foreach ($uneRevue->getLesNumeros() as $unNumero) { ?>

                                <div>
                                    <li>
                                        Numero Revue : <?= $unNumero->getNumero() ?> du : <?= $unNumero->getDateParution() ?> etat : <?= $unNumero->getEtat()->getLibelle() ?>
                                    </li>
                                    <?php
                                    $connexionManager = new ConnexionManager;
                                    if ($connexionManager->isLoggedOn()) { ?>
                                        <div class="rowR">
                                            <?php
                                            $reservationManager = new ReservationManager;
                                            $abonneManager = new AbonneManager;
                                            $abo = $abonneManager->getUtilisateurByMailU($_SESSION['mailU']);
                                            $reservation = $reservationManager->AfficherBouton($abo->getId(), $uneRevue->getId() , $unNumero->getNumero());
                                            if ($reservation) {
                                            ?>
                                            <a href="#addnew<?= $uneRevue->getId() ?><?= $unNumero->getNumero() ?>" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> RESERVER</a></br>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>

                                </div>


                                <!-- Add New -->

                                <div class="modal fade" id="addnew<?= $uneRevue->getId() ?><?= $unNumero->getNumero() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <center>
                                                    <h4 class="modal-title" id="myModalLabel">Est-ce bien le doument que vous désirez réserver : <strong><?= $uneRevue->getTitre() ?></strong></h4>
                                                </center>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <form method="POST" action="?action=reservation">
                                                        <div class="row form-group">
                                                            <?php
                                                            $reservationManager = new ReservationManager;
                                                            $reservations = $reservationManager->recupMaxRang($uneRevue->getId(), $unNumero->getNumero());
                                                            ?>
                                                            <p> Vous avez le rang <strong><?= $reservations + 1 ?> </strong>dans la liste des abonnées qui ont réservé ce document<?= $unNumero->getNumero() ?></p>
                                                        </div>
                                                        <div class="col-sm-10">

                                                            <input type="hidden" class="form-control" name="rang" value="<?= $reservations + 1 ?> ">

                                                            <input type="hidden" class="form-control" name="idRevue" value="<?= $uneRevue->getId() ?> ">

                                                            <input type="hidden" class="form-control" name="id" value="<?= $uneRevue->getId() ?>">

                                                            <input type="hidden" class="form-control" name="numeroParution" value="<?= $unNumero->getNumero() ?>">

                                                            <?php
                                                            $abonneManager = new abonneManager;
                                                            if ($connexionManager->isLoggedOn()) {
                                                                $abo = $abonneManager->getUtilisateurByMailU($_SESSION['mailU']);
                                                            ?>
                                                                <input type="hidden" class="form-control" name="idAbonne" value="<?= $abo->getId() ?>"> <?php } ?>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler la réservation</button>
                                                            <button type="submit" name="add" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> CONFIRMER</a>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
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