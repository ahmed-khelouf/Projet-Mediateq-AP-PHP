<div class="details bg-light">
    <div class="row justify-content-center mx-auto">
        <!-- Boucle itérant sur chaque exemplaire du DVD -->
        <?php foreach ($unDvd->getLesExemplaires() as $unExemplaire) { ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <!-- Section de l'image de couverture et du titre de la revue -->
                    <div class="card-body text-center">
                        <img class="img-fluid mx-auto d-block" src="images/Dvd/<?= $unDvd->getImage() ?>.jpg" alt="Couverture" width="30%">
                        <h5 class="card-title"><strong><?= $unDvd->getTitre() ?></strong></h5>
                    </div>
                    <!-- Section des informations du numéro de la revue -->
                    <div class="card-body text-center">
                        <ul>
                            <li>
                                <p class="card-text bleu"><strong>Réalisateur : <?= $unDvd->getRealisateur() ?></strong></p>
                            </li>
                            <li>
                                <p class="card-text vert"><strong>Public: <?= $unDvd->getTypePublic()->getLibelle() ?></strong></p>
                            </li>
                            <li>
                                <p class="card-text orange"><strong>Durée: <?= $unDvd->getDuree() ?> min</strong></p>
                            </li>
                            <li>
                                <p class="card-text violet"><strong>Etat : <?= $unExemplaire->getEtat()->getLibelle() ?></strong></p>
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
                            $reservation = $reservationExemplaireManager->AfficherBouton($abo->getId(), $unDvd->getId(), $unExemplaire->getNumero());
                            // Vérifie si l'utilisateur a réservé l'exemplaire ou non
                            if ($reservation) { ?>
                                <!-- Bouton de réservation -->
                                <a href="#addnew<?= $unDvd->getId() ?><?= $unExemplaire->getNumero() ?>" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> RÉSERVER</a>
                            <?php } else { ?>
                                <!-- Message si l'utilisateur a déjà réservé ce document -->
                                <span class="text-danger font-weight-bold">Vous avez déjà réservé un exemplaire de ce document</span>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
            <!-- Modal pour ajouter une nouvelle réservation -->
            <!-- Si la personne est connecté -->
            <?php if ($connexionManager->isLoggedOn()) { ?>
                <div class="modal fade" id="addnew<?= $unDvd->getId() ?><?= $unExemplaire->getNumero() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <div class="card-header text-center"><strong><?= $unDvd->getTitre() ?></strong></div>
                                    <div class="card-body">
                                        <p class="card-text">Realisateur : <?= $unDvd->getRealisateur() ?></p>
                                        <p class="card-text">Durée : <?= $unDvd->getDuree() ?></p>
                                        <p class="card-text">Public: <?= $unDvd->getTypePublic()->getLibelle() ?></p>
                                        <p class="card-text"><strong><span style="color:red;">État : <?= $unExemplaire->getEtat()->getLibelle() ?></span></strong></p>
                                        <p class="card-text"> <img class="img-fluid mx-auto d-block" src="images/Dvd/<?= $unDvd->getImage() ?>.jpg" alt="Couverture" width="30%">
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <form method="POST" action="?action=reservation">
                                        <?php
                                        // Récupérer le rangMax de l'utilisateur dans la liste des abonnés qui a réservé ce document (revue + numéro) 
                                        $reservations = $reservationExemplaireManager->recupMaxRang($unDvd->getId(), $unExemplaire->getNumero());
                                        ?>
                                        <!-- les champs cachés pour envoyer les données nécessaires à la ajout -->
                                        <input type="hidden" class="form-control" name="rang" value="<?= $reservations + 1 ?> ">
                                        <input type="hidden" class="form-control" name="idDoc" value="<?= $unDvd->getId()  ?> ">
                                        <input type="hidden" class="form-control" name="numeroExemplaire" value="<?= $unExemplaire->getNumero() ?>">
                                        <input type="hidden" class="form-control" name="idAbonne" value="<?= $abo->getId() ?>">
                                        <div class="row justify-content-center">
                                            <div class="col-8">
                                                <!-- Afficher le rang de l'utilisateur dans la liste des abonnés ayant réservé ce document -->
                                                <p class="text-center">Vous avez le rang <strong><span style="color:red;"><?= $reservations + 1 ?></span></strong> dans la liste des abonnés ayant réservé ce document</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <button type="submit" name="add" class="btn btn-primary">Confirmer la réservation</button>
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