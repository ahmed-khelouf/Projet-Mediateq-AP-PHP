<div class="details bg-light">
    <div class="row justify-content-center">
        <!-- Boucle itérant sur chaque exemplaire d'une revue -->
        <?php foreach ($uneRevue->getLesNumeros() as $unNumero) { ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <!-- Section de l'image de couverture et du titre de la revue -->
                    <div class="card-body text-center">
                        <img class="img-fluid mx-auto d-block" src="images/Revues/<?= $unNumero->getPhoto() ?>.jpg" alt="Couverture" width="50%">
                        <h5 class="card-title"><strong><?= $uneRevue->getTitre() ?></strong></h5>
                    </div>
                    <!-- Section des informations du numéro de la revue -->
                    <div class="card-body text-center">
                        <ul>
                            <li>
                                <p class="card-text bleu"><strong>Numéro : <?= $unNumero->getNumero() ?></strong></p>
                            </li>
                            <li>
                                <p class="card-text vert"><strong>Paru le : <?= $unNumero->getDateParution() ?></strong></p>
                            </li>
                            <li>
                                <p class="card-text orange"><strong>Etat : <?= $unNumero->getEtat()->getLibelle() ?></strong></p>
                            </li>
                            <li>
                                <p class="card-text violet"><strong> Type de document : <?= $unNumero->getRevue()->getDescripteur()->getLibelle() ?></strong></p>
                            </li>
                        </ul>
                    </div>
                    <!-- Section de réservation -->
                    <div class="card-body text-center">
                        <?php
                        // Si la personne est connecté
                        if ($connexionManager->isLoggedOn()) {
                            // Récupère l'utilisateur connecté
                            $abo = $abonneManager->getUtilisateurByMailU($_SESSION['mailU']);
                            // Vérifie si l'utilisateur a réservé cet exemplaire
                            $reservation = $reservationParutionManager->AfficherBouton($abo->getId(), $uneRevue->getId(), $unNumero->getNumero());
                            // Récupère le nombre de réservation de l'utilisateur
                            $nbreservation = $reservationManager->nombreReservationAutorise($abo->getId());
                            var_dump($nbreservation);
                            // Vérifie si l'utilisateur a réservé le nombre max de réservation
                            if ($nbreservation >= 2 && $abo->getTypeAbonnement()->getId() <= 3) { ?>
                                <span class="text-danger font-weight-bold">Tu as déja reservé le nombre max de reservation</span>
                                <?php } else {
                                // Vérifie si l'utilisateur a réservé l'exemplaire ou non
                                if ($reservation) { ?>
                                    <!-- Bouton de réservation -->
                                    <a href="#addnew<?= $uneRevue->getId() ?><?= $unNumero->getNumero() ?>" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> RÉSERVER</a>
                                <?php } else { ?>
                                    <!-- Message si l'utilisateur a déjà réservé ce document -->
                                    <span class="text-danger font-weight-bold">Vous avez déjà réservé ce document</span>
                        <?php }
                            }
                        } ?>
                    </div>
                </div>
            </div>
            <!-- Modal pour ajouter une nouvelle réservation -->
            <!-- Si la personne est connecté -->
            <?php if ($connexionManager->isLoggedOn()) { ?>
                <div class="modal fade" id="addnew<?= $uneRevue->getId() ?><?= $unNumero->getNumero() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <!-- Titre de la modal -->
                                <h4 class="modal-title" id="myModalLabel">Confirmation de la réservation</h4>
                                <!-- Bouton pour fermer la modal -->
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Texte de confirmation de la réservation -->
                                <p class="text-center">Êtes-vous sûr de vouloir réserver le document suivant ?</p>
                                <!-- Informations sur la revue et son numéro -->
                                <div class="card mb-3">
                                    <div class="card-header text-center"><strong><?= $uneRevue->getTitre() ?> numéro <?= $unNumero->getNumero() ?></strong></div>
                                    <div class="card-body">
                                        <p class="card-text">Type de document : <?= $uneRevue->getDescripteur()->getLibelle() ?></p>
                                        <p class="card-text">Paru le : <?= $unNumero->getDateParution() ?></p>
                                        <p class="card-text"><strong><span style="color:red;">État : <?= $unNumero->getEtat()->getLibelle() ?></span></strong></p>
                                        <p class="card-text"> <img class="img-fluid mx-auto d-block" src="images/Revues/<?= $unNumero->getPhoto() ?>.jpg" width="50%">
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <form method="POST" action="?action=reservation">
                                        <?php
                                        // Récupérer le rangMax de l'utilisateur dans la liste des abonnés qui a réservé ce document (revue + numéro) 
                                        $reservations = $reservationManager->recupMaxRang($uneRevue->getId(), $unNumero->getNumero());
                                        ?>
                                        <!-- les champs cachés pour envoyer les données nécessaires à la ajout -->
                                        <input type="hidden" class="form-control" name="rang" value="<?= $reservations + 1 ?> ">
                                        <input type="hidden" class="form-control" name="idRevue" value="<?= $uneRevue->getId() ?> ">
                                        <input type="hidden" class="form-control" name="numeroParution" value="<?= $unNumero->getNumero() ?>">
                                        <input type="hidden" class="form-control" name="idAbonne" value="<?= $abo->getId() ?>">
                                        <div class="row justify-content-center">
                                            <div class="col-8">
                                                <!-- Afficher le rang de l'utilisateur dans la liste des abonnés ayant réservé ce document -->
                                                <p class="text-center">Vous avez le rang <strong><span style="color:red;"><?= $reservations + 1 ?></span></strong> dans la liste des abonnés ayant réservé ce document</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <button type="submit" name="addRevue" class="btn btn-primary">Confirmer la réservation</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php  }
        } ?>
    </div>
</div>