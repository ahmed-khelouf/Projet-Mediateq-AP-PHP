<?php
// Vérification de la connexion de l'utilisateurs 
if ($connexionManager->isLoggedOn()) {
    // Récupération du nombre de réservations de l'abonné courant
    $reservation = $reservationManager->nombreReservation($unAbonne->getId());
?>
    <h1>Réservation de <?= $unAbonne->getNom() ?> <?= $unAbonne->getPrenom() ?></h1>
    <h3>Nombre de réservation <?= $reservation ?></h3>
    <?php
    ?>

    <h2>REVUES : </h2>
    <!-- Boucle pour afficher toutes les réservations de l'abonné courant -->
    <?php foreach ($reservationsParutions as $reservation) { ?>
        <!-- Vérification si la réservation est celle de l'abonné courant -->
        <?php if ($unAbonne->getId() === $reservation->getAbonne()->getId()) { ?>
            <tbody>
                <div class="row justify-content-center">
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-horizontal">
                                <div class="img-square-wrapper">
                                    <img class="img-fluid mx-auto d-block" src="images/Revues/<?= $reservation->getParution()->getPhoto() ?>.jpg" alt="Couverture">
                                </div>
                                <div class="trait-vertical"></div>
                                <div class="card-body">
                                    <h4 class="title"><?= $reservation->getRevue()->getTitre() ?></h4>
                                    <p class="card-text"> Type de document : <strong><?= $reservation->getRevue()->getDescripteur()->getLibelle() ?></strong></p>
                                    <div class="trait-horizontal"></div>
                                    <div class="rangStatut">
                                        <p> Rang : <strong><?= $reservation->getRang() ?></strong> </p>
                                        <p class="text-danger font-weight-bold"> Statut : <strong><?= $reservation->getStatut()->getLibelle() ?></strong></p>
                                    </div>
                                    <p> Date : <strong><?= $reservation->getDate() ?></strong></p>
                                    <p> Numero : <strong><?= $reservation->getParution()->getNumero() ?></strong></p>
                                    <a href='#delete_<?= $reservation->getId() ?>' class='btn btn-danger btn-sup' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Supprimer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </tbody>
            <!-- Modal pour confirmer la suppression de la réservation -->
            <?php if ($connexionManager->isLoggedOn()) { ?>
                <div class="modal fade" id="delete_<?= $reservation->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <!-- Titre de la modal -->
                                <h4 class="modal-title" id="myModalLabel">Confirmation de la suppression</h4>
                                <!-- Bouton pour fermer la modal -->
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Texte de confirmation de la réservation -->
                                <p class="text-center">Êtes-vous sûr de vouloir supprimer le document suivant ?</p>
                                <!-- Informations sur la revue et son numéro -->
                                <div class="card mb-3">
                                    <div class="card-header text-center"><strong><?= $reservation->getRevue()->getTitre() ?> numéro <?= $reservation->getParution()->getNumero() ?></strong></div>
                                    <div class="card-body">
                                        <p class="card-text">Date de réservation : <strong><?= $reservation->getDate() ?></strong></p>
                                        <p class="card-text"> <img class="img-fluid mx-auto d-block img-small" src="images/Revues/<?= $reservation->getParution()->getPhoto() ?>.jpg" alt="Couverture">
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <form method="POST" action="?action=reservation">
                                        <!-- les champs cachés pour envoyer les données nécessaires à la suppression -->
                                        <input type="hidden" class="form-control" name="idR" value="<?= $reservation->getId() ?>">
                                        <input type="hidden" class="form-control" name="idRevue" value="<?= $reservation->getRevue()->getId() ?>">
                                        <input type="hidden" class="form-control" name="rang" value="<?= $reservation->getRang() ?> ">
                                        <input type="hidden" class="form-control" name="numeroParution" value="<?= $reservation->getParution()->getNumero() ?> ">
                                        <div class="modal-footer">
                                            <!-- Bouton pour annuler la suppression -->
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>
                                            <!-- Bouton pour confirmer la suppression -->
                                            <button type="submit" name="supr" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Oui</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    <?php } ?>
    <!-- LIVRES -->
    <h2>LIVRES : </h2>
    <div class="">
        <!-- Boucle pour afficher toutes les réservations de l'abonné courant -->
        <?php foreach ($reservationsExemplairesLivres as $reservation) { ?>
            <!-- Vérification si la réservation est celle de l'abonné courant -->
            <?php if ($unAbonne->getId() === $reservation->getAbonne()->getId()) { ?>
                <tbody>
                    <div class="row justify-content-center">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-horizontal">
                                    <div class="img-square-wrapper">
                                        <img class="img-fluid mx-auto d-block" src="images/Livres/<?= $reservation->getDocument()->getImage() ?>.jpg" alt="Couverture">
                                    </div>
                                    <div class="trait-vertical"></div>
                                    <div class="card-body">
                                        <h4 class="title"><?= $reservation->getDocument()->getTitre() ?></h4>
                                        <p class="card-text"> Auteur : <strong><?= $reservation->getDocument()->getAuteur() ?></strong></p>
                                        <div class="trait-horizontal"></div>
                                        <div class="rangStatut">
                                            <p> Rang : <strong><?= $reservation->getRang() ?></strong> </p>
                                            <p class="text-danger font-weight-bold"> Statut : <strong><?= $reservation->getStatut()->getLibelle() ?></strong></p>
                                        </div>
                                        <p> Date : <strong><?= $reservation->getDate() ?></strong></p>
                                        <a href='#delete_<?= $reservation->getId() ?>' class='btn btn-danger btn-sup' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Supprimer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </tbody>
                <!-- Modal pour confirmer la suppression de la réservation -->
                <?php if ($connexionManager->isLoggedOn()) { ?>
                    <div class="modal fade" id="delete_<?= $reservation->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <!-- Titre de la modal -->
                                    <h4 class="modal-title" id="myModalLabel">Confirmation de la suppression</h4>
                                    <!-- Bouton pour fermer la modal -->
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Texte de confirmation de la réservation -->
                                    <p class="text-center">Êtes-vous sûr de vouloir supprimer le document suivant ?</p>
                                    <!-- Informations sur la revue et son numéro -->
                                    <div class="card mb-3">
                                        <div class="card-header text-center"><strong><?= $reservation->getDocument()->getTitre() ?> numéro <?= $reservation->getExemplaire()->getNumero() ?></strong></div>
                                        <div class="card-body">
                                            <p class="card-text">Date de réservation : <strong><?= $reservation->getDate() ?></strong></p>
                                            <p class="card-text"> <img class="img-fluid mx-auto d-block img-small" src="images/Livres/<?= $reservation->getDocument()->getImage() ?>.jpg" alt="Couverture">
                                        </div>
                                    </div>
                                    <div class="container-fluid">
                                        <form method="POST" action="?action=reservation">
                                            <!-- les champs cachés pour envoyer les données nécessaires à la suppression -->
                                            <input type="hidden" class="form-control" name="idR" value="<?= $reservation->getId() ?>">
                                            <input type="hidden" class="form-control" name="idDoc" value="<?= $reservation->getDocument()->getId() ?>">
                                            <input type="hidden" class="form-control" name="rang" value="<?= $reservation->getRang() ?> ">
                                            <input type="hidden" class="form-control" name="numeroExemplaire" value="<?= $reservation->getExemplaire()->getNumero() ?> ">

                                            <div class="modal-footer">
                                                <!-- Bouton pour annuler la suppression -->
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>
                                                <!-- Bouton pour confirmer la suppression -->
                                                <button type="submit" name="supr" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Oui</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
        <!-- DVD -->
        <h2>DVD : </h2>
        <div class="">
            <!-- Boucle pour afficher toutes les réservations de l'abonné courant -->
            <?php foreach ($reservationsExemplairesDVD as $reservation) { ?>
                <!-- Vérification si la réservation est celle de l'abonné courant -->
                <?php if ($unAbonne->getId() === $reservation->getAbonne()->getId()) { ?>
                    <tbody>
                        <div class="row justify-content-center">
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-horizontal">
                                        <div class="img-square-wrapper">
                                            <img class="img-fluid mx-auto d-block" src="images/Dvd/<?= $reservation->getDocument()->getImage() ?>.jpg" alt="Couverture">
                                        </div>
                                        <div class="trait-vertical"></div>
                                        <div class="card-body">
                                            <h4 class="title"><?= $reservation->getDocument()->getTitre() ?></h4>
                                            <p class="card-text"> Auteur : <strong><?= $reservation->getDocument()->getRealisateur() ?></strong></p>
                                            <div class="trait-horizontal"></div>
                                            <div class="rangStatut">
                                                <p> Rang : <strong><?= $reservation->getRang() ?></strong> </p>
                                                <p class="text-danger font-weight-bold"> Statut : <strong><?= $reservation->getStatut()->getLibelle() ?></strong></p>
                                            </div>
                                            <p> Date : <strong><?= $reservation->getDate() ?></strong></p>
                                            <a href='#delete_<?= $reservation->getId() ?>' class='btn btn-danger btn-sup' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Supprimer</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tbody>
                    <!-- Modal pour confirmer la suppression de la réservation -->
                    <?php if ($connexionManager->isLoggedOn()) { ?>
                        <div class="modal fade" id="delete_<?= $reservation->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <!-- Titre de la modal -->
                                        <h4 class="modal-title" id="myModalLabel">Confirmation de la suppression</h4>
                                        <!-- Bouton pour fermer la modal -->
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Texte de confirmation de la réservation -->
                                        <p class="text-center">Êtes-vous sûr de vouloir supprimer le document suivant ?</p>
                                        <!-- Informations sur la revue et son numéro -->
                                        <div class="card mb-3">
                                            <div class="card-header text-center"><strong><?= $reservation->getDocument()->getTitre() ?> numéro <?= $reservation->getExemplaire()->getNumero() ?></strong></div>
                                            <div class="card-body">
                                                <p class="card-text">Date de réservation : <strong><?= $reservation->getDate() ?></strong></p>
                                                <p class="card-text"> <img class="img-fluid mx-auto d-block img-small" src="images/Dvd/<?= $reservation->getDocument()->getImage() ?>.jpg" alt="Couverture">
                                            </div>
                                        </div>
                                        <div class="container-fluid">
                                            <form method="POST" action="?action=reservation">
                                                <!-- les champs cachés pour envoyer les données nécessaires à la suppression -->
                                                <input type="hidden" class="form-control" name="idR" value="<?= $reservation->getId() ?>">
                                                <input type="hidden" class="form-control" name="idDoc" value="<?= $reservation->getDocument()->getId() ?>">
                                                <input type="hidden" class="form-control" name="rang" value="<?= $reservation->getRang() ?> ">
                                                <input type="hidden" class="form-control" name="numeroExemplaire" value="<?= $reservation->getExemplaire()->getNumero() ?> ">

                                                <div class="modal-footer">
                                                    <!-- Bouton pour annuler la suppression -->
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>
                                                    <!-- Bouton pour confirmer la suppression -->
                                                    <button type="submit" name="supr" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Oui</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
<?php } ?>