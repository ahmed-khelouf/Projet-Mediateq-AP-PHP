<div class="revuedetails">
    <h2> <?= $uneRevue->getTitre() ?>:</h2>
    <table>
        <thead>
            <tr>
                <th>Couverture</th>
                <th>Titre de la revue</th>
                <th>Numéro de parution</th>
                <th>Date de parution</th>
                <th>Etat</th>
                <!-- Vérifier si l'utilisateur est connecté pour afficher la partie reserver du tableau  -->
                <?php if ($connexionManager->isLoggedOn()) { ?>
                    <th>Réserver</th>
                <?php  } ?>
            </tr>
        </thead>
        <tbody>
            <!-- Boucle pour parcourir tous les parution (numero) de la revue -->
            <?php foreach ($uneRevue->getLesNumeros() as $unNumero) { ?>
                <tr>
                    <td><img class="revue" src="images/Revues/<?= $unNumero->getPhoto() ?>.jpg"></td>
                    <td><?= $uneRevue->getTitre() ?></td>
                    <td><?= $unNumero->getNumero() ?></td>
                    <td><?= $unNumero->getDateParution() ?></td>
                    <td><?= $unNumero->getEtat()->getLibelle() ?></td>
                    <?php
                    if ($connexionManager->isLoggedOn()) {
                        //Vérifier si l'utilisateur a déjà réservé ce document
                        $abo = $abonneManager->getUtilisateurByMailU($_SESSION['mailU']);
                        $reservation = $reservationManager->AfficherBouton($abo->getId(), $uneRevue->getId(), $unNumero->getNumero());
                    ?>
                        <td>
                            <!-- Afficher le bouton "Réserver" si l'utilisateur n'a pas encore réservé ce document est qu'il est connecté -->
                            <?php if ($reservation) { ?>
                                <a href="#addnew<?= $uneRevue->getId() ?><?= $unNumero->getNumero() ?>" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> RESERVER</a></br>
                            <?php } else {
                                // Afficher un message si l'utilisateur a déjà réservé ce document
                                echo "Vous avez déjà réservé ce document";
                            } ?>
                        </td>
                    <?php } ?>
                </tr>
                <!-- Modal pour ajouter une nouvelle réservation -->
                <div class="modal fade" id="addnew<?= $uneRevue->getId() ?><?= $unNumero->getNumero() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <center>
                                    <h4 class="modal-title" id="myModalLabel">Est-ce bien le doument que vous désirez réserver : <strong><?= $uneRevue->getTitre() ?> numero : <?= $unNumero->getNumero() ?></strong></h4>
                                </center>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form method="POST" action="?action=reservation">
                                        <div class="row form-group">
                                            <?php
                                            // Récupérer le rangMax de l'utilisateur dans la liste des abonnés qui a réservé ce document (revue + numéro) 
                                            $reservations = $reservationManager->recupMaxRang($uneRevue->getId(), $unNumero->getNumero());
                                            ?>
                                            <p> Vous avez le rang <strong><?= $reservations + 1 ?> </strong>dans la liste des abonnées qui ont réservé ce document</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <!-- les champs cachés pour envoyer les données nécessaires à la ajout -->
                                            <input type="hidden" class="form-control" name="rang" value="<?= $reservations + 1 ?> ">
                                            <input type="hidden" class="form-control" name="idRevue" value="<?= $uneRevue->getId() ?> ">
                                            <input type="hidden" class="form-control" name="numeroParution" value="<?= $unNumero->getNumero() ?>">
                                            <input type="hidden" class="form-control" name="idAbonne" value="<?= $abo->getId() ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <!-- Bouton pour annuler la réservation -->
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler la réservation</button>
                                            <!-- Bouton pour confirmer la réservation -->
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