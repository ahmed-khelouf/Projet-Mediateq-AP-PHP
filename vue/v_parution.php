<div class="revuedetails">
    <h2> <?=$uneRevue->getTitre()?>:</h2>
    <table>
        <thead>
            <tr>
                <th>Couverture</th>
                <th>Titre de la revue</th>
                <th>Numéro de parution</th>
                <th>Date de parution</th>
                <th>Etat</th>
                <?php if ($connexionManager->isLoggedOn()) { ?>
                    <th>Réserver</th>
               <?php  } ?>
            </tr>
        </thead>
        <tbody>
                <?php foreach ($uneRevue->getLesNumeros() as $unNumero) { ?>
                    <tr>
                        <td><img class="revue" src="images/Revues/<?=$unNumero->getPhoto()?>.jpg"></td>
                        <td><?= $uneRevue->getTitre() ?></td>
                        <td><?= $unNumero->getNumero() ?></td>
                        <td><?= $unNumero->getDateParution() ?></td>
                        <td><?= $unNumero->getEtat()->getLibelle() ?></td>
                        <?php
                        $connexionManager = new ConnexionManager;
                        if ($connexionManager->isLoggedOn()) {
                            $reservationManager = new ReservationManager;
                            $abonneManager = new AbonneManager;
                            $abo = $abonneManager->getUtilisateurByMailU($_SESSION['mailU']);
                            $reservation = $reservationManager->AfficherBouton($abo->getId(), $uneRevue->getId(), $unNumero->getNumero());
                        ?>
                            <td>
                                <?php if ($reservation) { ?>
                                    <a href="#addnew<?= $uneRevue->getId() ?><?= $unNumero->getNumero() ?>" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> RESERVER</a></br>
                                <?php }else{
                                    echo "Vous avez déjà réservé ce document";
                                } ?>
                            </td>
                        <?php } ?>
                    </tr>
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
        </tbody>
    </table>
</div>