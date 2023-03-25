<?php
// Récupération du nombre de réservations de l'abonné courant
$reservation = $reservationParutionManager->nombreReservation($unAbonne->getId());
?>
<h1>Réservation de <?= $unAbonne->getNom() ?> ID numero <?= $unAbonne->getId() ?></h1>
<h3>Nombre de réservation <?= $reservation ?></h3>
<?php
?>
<h1>Revue : </h1>
<?php
// Vérification de la connexion de l'utilisateurs
if ($connexionManager->isLoggedOn()) { ?>
    <div class="">
        <!-- Boucle pour afficher toutes les réservations de l'abonné courant -->
        <?php foreach ($reservationsParutions as $reservation) { ?>
            <!-- Vérification si la réservation est celle de l'abonné courant -->
            <?php if ($unAbonne->getId() === $reservation->getAbonne()->getId()) { ?>
                <tbody>
                    <div class="row">
                        <div class="col-12 mt-3">
                            <div class="card">
                                <div class="card-horizontal">
                                    <div class="img-square-wrapper">
                                        <img class="" src="" alt="<?= $reservation->getRevue()->getTitre() ?>">
                                    </div>
                                    <div class="trait-vertical"></div>
                                    <div class="card-body">
                                        <h4 class="title"><?= $reservation->getRevue()->getTitre() ?></h4>
                                        <p class="card-text"> Type de document : <strong><?= $reservation->getRevue()->getDescripteur()->getLibelle() ?></strong></p>
                                        <div class="trait-horizontal"></div>
                                        <div class="rangStatut">
                                            <p> Rang : <strong><?= $reservation->getRang() ?></strong> </p>
                                            <p> Statut : <strong><?= $reservation->getStatut()->getLibelle() ?></strong></p>
                                        </div>
                                        <p> Date : <strong><?= $reservation->getDate() ?></strong></p>
                                        <p> Numero : <strong><?= $reservation->getNumeroParution() ?></strong></p>
                                        <a href='#delete_<?= $reservation->getId() ?>' class='btn btn-danger btn-sup' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Supprimer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </tbody>
                <!-- Modal pour confirmer la suppression de la réservation -->
                <div class="modal fade" id="delete_<?= $reservation->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <center>
                                    <h4 class="modal-title" id="myModalLabel">Supprimer la reservation</h4>
                                </center>
                            </div>
                            <div class="modal-body">
                                <p class="text-center">Etes-vous sur de vouloir supprimer la reservation</p>
                            </div>
                            <div class="modal-footer">
                                <form method="POST" action="?action=reservation">
                                    <!-- les champs cachés pour envoyer les données nécessaires à la suppression -->
                                    <input type="hidden" class="form-control" name="idR" value="<?= $reservation->getId() ?>">
                                    <input type="hidden" class="form-control" name="idRevue" value="<?= $reservation->getRevue()->getId() ?>">
                                    <input type="hidden" class="form-control" name="rang" value="<?= $reservation->getRang() ?> ">
                                    <input type="hidden" class="form-control" name="numeroParution" value="<?= $reservation->getNumeroParution() ?> ">
                                    <!-- Bouton pour annuler la suppression -->
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>
                                    <!-- Bouton pour confirmer la suppression -->
                                    <button type="submit" name="supr" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Oui</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    <?php } ?>
<h1>Livres</h1>
<?php
    // Vérification de la connexion de l'utilisateurs
if ($connexionManager->isLoggedOn()) { ?>
    <div class="">
        <!-- Boucle pour afficher toutes les réservations de l'abonné courant -->
        <?php foreach ($reservationsExemplaires as $reservation) { ?>
            <!-- Vérification si la réservation est celle de l'abonné courant -->
            <?php if ($unAbonne->getId() === $reservation->getAbonne()->getId()) { ?>
                <tbody>
                    <div class="row">
                        <div class="col-12 mt-3">
                            <div class="card">
                                <div class="card-horizontal">
                                    <div class="img-square-wrapper">
                                        <img class="" src="" alt="<?= $reservation->getDocument()->getTitre() ?>">
                                    </div>
                                    <div class="trait-vertical"></div>
                                    <div class="card-body">
                                        <h4 class="title"><?= $reservation->getDocument()->getTitre() ?></h4>
                                        <div class="trait-horizontal"></div>
                                        <div class="rangStatut">
                                            <p> Rang : <strong><?= $reservation->getRang() ?></strong> </p>
                                            <p> Statut : <strong><?= $reservation->getStatut()->getLibelle() ?></strong></p>
                                        </div>
                                        <p> Date : <strong><?= $reservation->getDate() ?></strong></p>
                                        <p> Numero : <strong><?= $reservation->getNumeroExemplaire() ?></strong></p>
                                        <a href='#delete_<?= $reservation->getId() ?>' class='btn btn-danger btn-sup' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Supprimer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </tbody>
                <!-- Modal pour confirmer la suppression de la réservation -->
                <div class="modal fade" id="delete_<?= $reservation->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <center>
                                    <h4 class="modal-title" id="myModalLabel">Supprimer la reservation</h4>
                                </center>
                            </div>
                            <div class="modal-body">
                                <p class="text-center">Etes-vous sur de vouloir supprimer la reservation</p>
                            </div>
                            <div class="modal-footer">
                                <form method="POST" action="?action=reservation">
                                    <!-- les champs cachés pour envoyer les données nécessaires à la suppression -->
                                    <input type="hidden" class="form-control" name="idR" value="<?= $reservation->getId() ?>">
                                    <input type="hidden" class="form-control" name="idDoc" value="<?= $reservation->getDocument()->getId() ?>">
                                    <input type="hidden" class="form-control" name="rang" value="<?= $reservation->getRang() ?> ">
                                    <input type="hidden" class="form-control" name="numeroExemplaire" value="<?= $reservation->getNumeroExemplaire() ?> ">
                                    <!-- Bouton pour annuler la suppression -->
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>
                                    <!-- Bouton pour confirmer la suppression -->
                                    <button type="submit" name="supr" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Oui</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    <?php } ?>

